<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedias = SocialMedia::paginate(10);
        return view('admin.social_medias.index', compact('socialMedias'));
    }

    public function create()
    {
        return view('admin.social_medias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'url' => 'required|url',
            'icon_class' => 'nullable|string|max:255',
            'custom_logo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('custom_logo')) {
            $validated['custom_logo_path'] = $request->file('custom_logo')->store('social_media', 'public');
        }

        unset($validated['custom_logo']);

        SocialMedia::create($validated);
        return redirect()->route('admin.social_medias.index')->with('success', 'Sosial Media berhasil ditambahkan.');
    }

    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social_medias.edit', compact('socialMedia'));
    }

    public function update(Request $request, SocialMedia $socialMedia)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'url' => 'required|url',
            'icon_class' => 'nullable|string|max:255',
            'custom_logo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('custom_logo')) {
            // Hapus logo lama jika ada
            if ($socialMedia->custom_logo_path) {
                Storage::disk('public')->delete($socialMedia->custom_logo_path);
            }
            $validated['custom_logo_path'] = $request->file('custom_logo')->store('social_media', 'public');
        }

        // Jika user mencentang hapus logo
        if ($request->has('remove_logo') && !$request->hasFile('custom_logo')) {
            if ($socialMedia->custom_logo_path) {
                Storage::disk('public')->delete($socialMedia->custom_logo_path);
            }
            $validated['custom_logo_path'] = null;
        }

        unset($validated['custom_logo']);

        $socialMedia->update($validated);
        return redirect()->route('admin.social_medias.index')->with('success', 'Sosial Media berhasil diperbarui.');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        if ($socialMedia->custom_logo_path) {
            Storage::disk('public')->delete($socialMedia->custom_logo_path);
        }
        $socialMedia->delete();
        return redirect()->route('admin.social_medias.index')->with('success', 'Sosial Media berhasil dihapus.');
    }
}
