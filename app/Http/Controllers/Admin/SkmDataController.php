<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SkmData;
use Illuminate\Support\Facades\Storage;

class SkmDataController extends Controller
{
    public function index()
    {
        $skmData = SkmData::orderBy('year', 'desc')->paginate(10);
        return view('admin.skm_data.index', compact('skmData'));
    }

    public function create()
    {
        return view('admin.skm_data.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'period' => 'required|string|max:255',
            'index_value' => 'required|numeric',
            'category' => 'required|string|max:255',
            'document_path' => 'nullable|file|mimes:pdf|max:10240',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['is_active'] = $request->has('is_active');

        if ($validated['is_active']) {
            SkmData::where('id', '>', 0)->update(['is_active' => false]);
        }

        if ($request->hasFile('document_path')) {
            $validated['document_path'] = $request->file('document_path')->store('skm_docs', 'public');
        }

        SkmData::create($validated);
        return redirect()->route('admin.skm_data.index')->with('success', 'Data SKM berhasil ditambahkan.');
    }

    public function edit(SkmData $skmDatum)
    {
        return view('admin.skm_data.edit', compact('skmDatum'));
    }

    public function update(Request $request, SkmData $skmDatum)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'period' => 'required|string|max:255',
            'index_value' => 'required|numeric',
            'category' => 'required|string|max:255',
            'document_path' => 'nullable|file|mimes:pdf|max:10240',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['is_active'] = $request->has('is_active');

        if ($validated['is_active']) {
            SkmData::where('id', '!=', $skmDatum->id)->update(['is_active' => false]);
        }

        if ($request->hasFile('document_path')) {
            if ($skmDatum->document_path) {
                Storage::disk('public')->delete($skmDatum->document_path);
            }
            $validated['document_path'] = $request->file('document_path')->store('skm_docs', 'public');
        }

        $skmDatum->update($validated);
        return redirect()->route('admin.skm_data.index')->with('success', 'Data SKM berhasil diperbarui.');
    }

    public function destroy(SkmData $skmDatum)
    {
        if ($skmDatum->document_path) {
            Storage::disk('public')->delete($skmDatum->document_path);
        }
        $skmDatum->delete();
        return redirect()->route('admin.skm_data.index')->with('success', 'Data SKM berhasil dihapus.');
    }
}
