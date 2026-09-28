<?php

namespace App\Support;

class Media
{
    public static function url(?string $key): ?string
    {
        if (! $key || ! str_contains($key, '/')) {
            return null;
        }

        [$folder, $filename] = explode('/', $key, 2);

        return route('public.file', compact('folder', 'filename'));
    }
}
