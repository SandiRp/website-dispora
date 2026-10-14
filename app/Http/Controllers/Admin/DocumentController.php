<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('category', 'user')->latest()->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $categories = Category::where('type', 'document')->get();
        return view('admin.documents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'access_type' => 'required|in:public,internal_only',
            'document_file' => 'required|file|max:5120', // max 5MB
        ]);

        $file = $request->file('document_file');
        
        $validated['file_path'] = $file->store('private/documents', 'local');
        $validated['file_type'] = $file->getClientOriginalExtension();
        $validated['file_size'] = $file->getSize();
        $validated['user_id'] = auth()->id();
        
        // Remove document_file from array as it's not a model attribute
        unset($validated['document_file']);

        Document::create($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Document uploaded successfully.');
    }

    public function edit(Document $document)
    {
        $categories = Category::where('type', 'document')->get();
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'access_type' => 'required|in:public,internal_only',
            'document_file' => 'nullable|file|max:5120',
        ]);

        if ($request->hasFile('document_file')) {
            if ($document->file_path) {
                Storage::disk('local')->delete($document->file_path);
            }
            $file = $request->file('document_file');
            $validated['file_path'] = $file->store('private/documents', 'local');
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }
        
        unset($validated['document_file']);

        $document->update($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('local')->delete($document->file_path);
        }
        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Document deleted successfully.');
    }
}
