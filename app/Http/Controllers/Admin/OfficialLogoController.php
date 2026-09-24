<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficialLogoController extends Controller
{
    public function index()
    {
        $logos = OfficialLogo::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.official_logos.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.official_logos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:5120',
            'file_path' => 'nullable|file|mimes:png,jpg,jpeg|max:5120',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('official_logos/images', 'public');
        }

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('official_logos/files', 'public');
        }

        OfficialLogo::create($validated);
        return redirect()->route('admin.official_logos.index')->with('success', 'Logo resmi berhasil ditambahkan.');
    }

    public function edit(OfficialLogo $officialLogo)
    {
        return view('admin.official_logos.edit', compact('officialLogo'));
    }

    public function update(Request $request, OfficialLogo $officialLogo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:5120',
            'file_path' => 'nullable|file|mimes:png,jpg,jpeg|max:5120',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;

        if ($request->hasFile('image_path')) {
            if ($officialLogo->image_path) Storage::disk('public')->delete($officialLogo->image_path);
            $validated['image_path'] = $request->file('image_path')->store('official_logos/images', 'public');
        }

        if ($request->hasFile('file_path')) {
            if ($officialLogo->file_path) Storage::disk('public')->delete($officialLogo->file_path);
            $validated['file_path'] = $request->file('file_path')->store('official_logos/files', 'public');
        }

        $officialLogo->update($validated);
        return redirect()->route('admin.official_logos.index')->with('success', 'Logo resmi berhasil diperbarui.');
    }

    public function destroy(OfficialLogo $officialLogo)
    {
        if ($officialLogo->image_path) Storage::disk('public')->delete($officialLogo->image_path);
        if ($officialLogo->file_path) Storage::disk('public')->delete($officialLogo->file_path);
        
        $officialLogo->delete();
        return redirect()->route('admin.official_logos.index')->with('success', 'Logo resmi berhasil dihapus.');
    }
}
