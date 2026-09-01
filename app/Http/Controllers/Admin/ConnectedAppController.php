<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ConnectedApp;
use Illuminate\Support\Facades\Storage;

class ConnectedAppController extends Controller
{
    public function index()
    {
        $apps = ConnectedApp::orderBy('order')->paginate(10);
        return view('admin.connected_apps.index', compact('apps'));
    }

    public function create()
    {
        return view('admin.connected_apps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url_link' => 'nullable|url',
            'logo_path' => 'nullable|image|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request->file('logo_path')->store('connected_apps', 'public');
        }

        ConnectedApp::create($validated);
        return redirect()->route('admin.connected_apps.index')->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    public function edit(ConnectedApp $connectedApp)
    {
        return view('admin.connected_apps.edit', compact('connectedApp'));
    }

    public function update(Request $request, ConnectedApp $connectedApp)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url_link' => 'nullable|url',
            'logo_path' => 'nullable|image|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo_path')) {
            if ($connectedApp->logo_path) {
                Storage::disk('public')->delete($connectedApp->logo_path);
            }
            $validated['logo_path'] = $request->file('logo_path')->store('connected_apps', 'public');
        }

        $connectedApp->update($validated);
        return redirect()->route('admin.connected_apps.index')->with('success', 'Aplikasi berhasil diperbarui.');
    }

    public function destroy(ConnectedApp $connectedApp)
    {
        if ($connectedApp->logo_path) {
            Storage::disk('public')->delete($connectedApp->logo_path);
        }
        $connectedApp->delete();
        return redirect()->route('admin.connected_apps.index')->with('success', 'Aplikasi berhasil dihapus.');
    }
}
