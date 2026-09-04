<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::orderBy('order')->paginate(10);
        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'pic_name' => 'nullable|string|max:255',
            'pic_phone' => 'nullable|string|max:50',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('venues', 'public');
        }

        Venue::create($validated);
        return redirect()->route('admin.venues.index')->with('success', 'Venue berhasil ditambahkan.');
    }

    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'pic_name' => 'nullable|string|max:255',
            'pic_phone' => 'nullable|string|max:50',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_path')) {
            if ($venue->image_path) {
                Storage::disk('public')->delete($venue->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('venues', 'public');
        }

        $venue->update($validated);
        return redirect()->route('admin.venues.index')->with('success', 'Venue berhasil diperbarui.');
    }

    public function destroy(Venue $venue)
    {
        if ($venue->image_path) {
            Storage::disk('public')->delete($venue->image_path);
        }
        $venue->delete();
        return redirect()->route('admin.venues.index')->with('success', 'Venue berhasil dihapus.');
    }
}
