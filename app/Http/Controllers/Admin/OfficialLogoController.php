<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialLogo;
use Illuminate\Http\Request;
use App\Support\Uploads;

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

        $officialLogo = Uploads::save(new OfficialLogo(), $validated, [
            'image_path' => [$request->file('image_path'), 'official_logos/images'],
            'file_path' => [$request->file('file_path'), 'official_logos/files'],
        ]);
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

        Uploads::save($officialLogo, $validated, [
            'image_path' => [$request->file('image_path'), 'official_logos/images'],
            'file_path' => [$request->file('file_path'), 'official_logos/files'],
        ]);
        return redirect()->route('admin.official_logos.index')->with('success', 'Logo resmi berhasil diperbarui.');
    }

    public function destroy(OfficialLogo $officialLogo)
    {
        if ($officialLogo->delete()) {
            Uploads::delete($officialLogo->image_path, $officialLogo->file_path);
        }
        return redirect()->route('admin.official_logos.index')->with('success', 'Logo resmi berhasil dihapus.');
    }
}
