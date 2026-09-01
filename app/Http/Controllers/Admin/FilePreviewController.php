<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilePreviewController extends Controller
{
    public function show($folder, $filename)
    {
        // Try multiple possible paths because Laravel 13's local disk
        // defaults to storage/app/private. Files stored as "private/documents/x"
        // end up at storage/app/private/private/documents/x.
        $possiblePaths = [
            "private/{$folder}/{$filename}",
            "{$folder}/{$filename}",
        ];

        $foundPath = null;
        foreach ($possiblePaths as $path) {
            if (Storage::disk('local')->exists($path)) {
                $foundPath = $path;
                break;
            }
        }

        if (!$foundPath) {
            abort(404, 'File not found.');
        }

        $mimeType = Storage::disk('local')->mimeType($foundPath);
        $fullPath = Storage::disk('local')->path($foundPath);
        
        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
