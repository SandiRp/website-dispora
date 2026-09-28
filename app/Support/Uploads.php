<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Throwable;

class Uploads
{
    /** @param array<string, array{UploadedFile|null, string}> $uploads */
    public static function save(Model $model, array $attributes, array $uploads): Model
    {
        $fields = $attributes;
        $attributes = array_filter($attributes, fn ($value) => ! $value instanceof UploadedFile);
        $new = [];
        $old = [];

        try {
            foreach ($uploads as $attribute => [$file, $prefix]) {
                unset($attributes[$attribute]);
                if ($file === null) {
                    continue;
                }

                // Request fields can differ from model attributes (document_file / file_path).
                $field = array_search($file, $fields, true);
                $new[$attribute] = self::store($file, $prefix, $field === false ? $attribute : $field);
                $old[] = $model->getAttribute($attribute);
                $attributes[$attribute] = $new[$attribute];
            }

            $model->fill($attributes);
            if (! $model->save()) {
                throw new RuntimeException('Unable to save uploaded media.');
            }
        } catch (Throwable $exception) {
            self::delete(...array_values($new));
            throw $exception;
        }

        self::delete(...$old);

        return $model;
    }

    public static function store(UploadedFile $file, string $prefix, string $field): string
    {
        try {
            $key = $file->store($prefix, ['disk' => 's3', 'visibility' => 'private']);
            if (! is_string($key) || $key === '') {
                throw new RuntimeException('Upload failed.');
            }

            return $key;
        } catch (Throwable) {
            Log::warning('S3 media upload failed.');
            throw ValidationException::withMessages([
                $field => 'File gagal diunggah. Silakan coba lagi.',
            ]);
        }
    }

    public static function delete(?string ...$keys): void
    {
        foreach ($keys as $key) {
            if (! $key) {
                continue;
            }

            try {
                if (! Storage::disk('s3')->delete($key)) {
                    Log::warning('S3 media cleanup failed.');
                }
            } catch (Throwable) {
                Log::warning('S3 media cleanup failed.');
            }
        }
    }
}
