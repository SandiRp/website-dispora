<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

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
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $socialMedia->update($validated);
        return redirect()->route('admin.social_medias.index')->with('success', 'Sosial Media berhasil diperbarui.');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();
        return redirect()->route('admin.social_medias.index')->with('success', 'Sosial Media berhasil dihapus.');
    }
}
