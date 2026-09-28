<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SkmData;
use App\Support\Uploads;

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
            'document_path' => 'nullable|file|mimes:pdf|max:5120',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['is_active'] = $request->has('is_active');

        if ($validated['is_active']) {
            SkmData::where('id', '>', 0)->update(['is_active' => false]);
        }

        $skmDatum = Uploads::save(new SkmData(), $validated, [
            'document_path' => [$request->file('document_path'), 'skm_docs'],
        ]);
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
            'document_path' => 'nullable|file|mimes:pdf|max:5120',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['is_active'] = $request->has('is_active');

        if ($validated['is_active']) {
            SkmData::where('id', '!=', $skmDatum->id)->update(['is_active' => false]);
        }

        Uploads::save($skmDatum, $validated, [
            'document_path' => [$request->file('document_path'), 'skm_docs'],
        ]);
        return redirect()->route('admin.skm_data.index')->with('success', 'Data SKM berhasil diperbarui.');
    }

    public function destroy(SkmData $skmDatum)
    {
        if ($skmDatum->delete()) {
            Uploads::delete($skmDatum->document_path);
        }
        return redirect()->route('admin.skm_data.index')->with('success', 'Data SKM berhasil dihapus.');
    }
}
