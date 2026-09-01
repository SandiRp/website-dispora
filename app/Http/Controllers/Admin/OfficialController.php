<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = \App\Models\Official::orderBy('order')->paginate(10);
        return view('admin.officials.index', compact('officials'));
    }

    public function create()
    {
        return view('admin.officials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('officials', 'public');
        }

        \App\Models\Official::create($validated);
        return redirect()->route('admin.officials.index')->with('success', 'Pejabat berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(\App\Models\Official $official)
    {
        return view('admin.officials.edit', compact('official'));
    }

    public function update(Request $request, \App\Models\Official $official)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($official->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($official->photo);
            }
            $validated['photo'] = $request->file('photo')->store('officials', 'public');
        }

        $official->update($validated);
        return redirect()->route('admin.officials.index')->with('success', 'Pejabat berhasil diperbarui.');
    }

    public function destroy(\App\Models\Official $official)
    {
        if ($official->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($official->photo);
        }
        $official->delete();
        return redirect()->route('admin.officials.index')->with('success', 'Pejabat berhasil dihapus.');
    }
}
