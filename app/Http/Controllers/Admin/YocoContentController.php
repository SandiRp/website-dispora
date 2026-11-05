<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YocoContent;
use App\Support\Uploads;
use Illuminate\Http\Request;

class YocoContentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = YocoContent::query();
        $allowedTypes = array_keys(YocoContent::types());

        if ($type && in_array($type, $allowedTypes, true)) {
            $query->where('type', $type);
        }

        $contents = $query->orderBy('type')->orderBy('order')->orderBy('created_at', 'desc')->get();
        $counts = [
            'all' => YocoContent::count(),
        ];
        foreach ($allowedTypes as $t) {
            $counts[$t] = YocoContent::where('type', $t)->count();
        }

        return view('admin.yoco_contents.index', compact('contents', 'type', 'counts'));
    }

    public function create()
    {
        $types = YocoContent::types();
        return view('admin.yoco_contents.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(YocoContent::types())),
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|image|max:5120',
            'link_url' => 'nullable|url|max:255',
            'link_label' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;
        $validated['link_label'] = $request->filled('link_label') ? $request->link_label : 'Selengkapnya';

        Uploads::save(new YocoContent(), $validated, [
            'image_path' => [$request->file('image_path'), 'yoco_contents'],
        ]);

        return redirect()->route('admin.yoco_contents.index')->with('success', 'Konten YOCO berhasil ditambahkan.');
    }

    public function edit(YocoContent $yocoContent)
    {
        $types = YocoContent::types();
        return view('admin.yoco_contents.edit', compact('yocoContent', 'types'));
    }

    public function update(Request $request, YocoContent $yocoContent)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys(YocoContent::types())),
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|image|max:5120',
            'link_url' => 'nullable|url|max:255',
            'link_label' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $request->order ?? 0;
        $validated['link_label'] = $request->filled('link_label') ? $request->link_label : 'Selengkapnya';

        Uploads::save($yocoContent, $validated, [
            'image_path' => [$request->file('image_path'), 'yoco_contents'],
        ]);

        return redirect()->route('admin.yoco_contents.index')->with('success', 'Konten YOCO berhasil diperbarui.');
    }

    public function destroy(YocoContent $yocoContent)
    {
        if ($yocoContent->delete()) {
            Uploads::delete($yocoContent->image_path);
        }

        return redirect()->route('admin.yoco_contents.index')->with('success', 'Konten YOCO berhasil dihapus.');
    }
}

