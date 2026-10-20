<?php

namespace App\Http\Controllers;

use App\Models\{Announcement, ConnectedApp, Document, Official, OfficialLogo, Post, Service, SkmData, Venue};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class MediaController extends Controller
{
    public function show(Request $request, string $folder, string $filename)
    {
        $catalog = [
            'documents' => [Document::class, ['file_path']],
            'skm_docs' => [SkmData::class, ['document_path']],
            'services' => [Service::class, ['icon_path']],
            'venues' => [Venue::class, ['image_path']],
            'connected_apps' => [ConnectedApp::class, ['logo_path']],
            'officials' => [Official::class, ['photo']],
            'official_logos' => [OfficialLogo::class, ['image_path', 'file_path']],
            'announcements' => [Announcement::class, ['image_path']],
        ];
        $headers = ['Cache-Control' => 'private, no-store', 'Referrer-Policy' => 'no-referrer'];
        $unavailable = function (int $status) use ($request, $headers) {
            $message = 'File tidak tersedia atau sementara tidak dapat diakses.';

            return $request->boolean('resolve') || $request->expectsJson()
                ? response()->json(['message' => $message], $status, $headers)
                : response($message, $status, $headers + ['Content-Type' => 'text/plain; charset=UTF-8']);
        };

        // Only generated media filenames and the two known nested logo prefixes.
        $pattern = $folder === 'official_logos'
            ? '~\A(?:images|files)/[A-Za-z0-9_-]+\.[A-Za-z0-9]+\z~'
            : '~\A[A-Za-z0-9_-]+\.[A-Za-z0-9]+\z~';
        if (($folder !== 'posts' && ! isset($catalog[$folder])) || ! preg_match($pattern, $filename)) {
            return $unavailable(404);
        }

        $key = "$folder/$filename";
        if ($folder === 'posts') {
            // Unsaved editor images can be previewed by the existing authenticated editors.
            $allowed = (bool) $request->user();
            if (! $allowed) {
                $origin = preg_quote(rtrim((string) config('app.url'), '/'), '~');
                $reference = '~\b(?:src|href)=["\'](?:'.$origin.')?/(?:file|admin/files)/posts/'.preg_quote($filename, '~').'["\']~';
                $allowed = Post::where('status', 'published')
                    ->where(fn ($query) => $query->where('featured_image', $key)->orWhere('content', 'like', '%'.$filename.'%'))
                    ->get(['featured_image', 'content'])
                    ->contains(fn ($post) => $post->featured_image === $key || preg_match($reference, (string) $post->content));
            }
        } else {
            [$model, $columns] = $catalog[$folder];
            $query = $model::where(function ($query) use ($columns, $key) {
                foreach ($columns as $column) {
                    $query->orWhere($column, $key);
                }
            });
            if ($folder === 'documents' && ! $request->user()) {
                $query->where('access_type', 'public');
            }
            $allowed = $query->get($columns)->contains(fn ($record) => in_array($key, $record->only($columns), true));
        }
        if (! $allowed) {
            return $unavailable(404);
        }

        try {
            $disk = Storage::disk('s3');
            // Images have browser fallbacks; resolve/download requests check existence on demand.
            if (($request->boolean('resolve') || in_array($folder, ['documents', 'skm_docs'], true) || $request->boolean('download')) && ! $disk->exists($key)) {
                return $unavailable(404);
            }
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $type = match ($extension) {
                'jpg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif',
                'webp' => 'image/webp', 'bmp' => 'image/bmp', 'pdf' => 'application/pdf',
                default => 'application/octet-stream',
            };
            $disposition = $request->boolean('download') || $type === 'application/octet-stream' ? 'attachment' : 'inline';
            $expires = now()->addMinutes(max(1, min(60, (int) config('filesystems.temp_url_minutes', 15))));
            $url = $disk->temporaryUrl($key, $expires, [
                'ResponseContentType' => $type,
                'ResponseContentDisposition' => $disposition.'; filename="'.basename($filename).'"',
                'ResponseCacheControl' => 'private, no-store',
            ]);

            return $request->boolean('resolve') || $request->expectsJson()
                ? response()->json(['url' => $url, 'expires_at' => $expires->toIso8601String()], 200, $headers)
                : redirect()->away($url, 302, $headers);
        } catch (Throwable) {
            // SDK exceptions can contain signed URLs; never put them in logs or responses.
            Log::warning('S3 media access failed.');

            return $unavailable(503);
        }
    }
}
