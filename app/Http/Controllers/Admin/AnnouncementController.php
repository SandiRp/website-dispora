<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('announcements', 'public');
        }

        Announcement::create($validated);
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;

        if ($request->hasFile('image_path')) {
            if ($announcement->image_path) Storage::disk('public')->delete($announcement->image_path);
            $validated['image_path'] = $request->file('image_path')->store('announcements', 'public');
        }

        $announcement->update($validated);
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->image_path) Storage::disk('public')->delete($announcement->image_path);
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
