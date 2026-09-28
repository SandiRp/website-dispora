<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use App\Support\Uploads;

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
            'document_file' => 'required|file|max:5120', // max 10MB
        ]);

        $file = $request->file('document_file');
        
        $validated['file_type'] = $file->getClientOriginalExtension();
        $validated['file_size'] = $file->getSize();
        $validated['user_id'] = auth()->id();
        
        $document = Uploads::save(new Document(), $validated, [
            'file_path' => [$file, 'documents'],
        ]);

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
            $file = $request->file('document_file');
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        } else {
            unset($validated['document_file']);
        }

        Uploads::save($document, $validated, [
            'file_path' => [$request->file('document_file'), 'documents'],
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        if ($document->delete()) {
            Uploads::delete($document->file_path);
        }

        return redirect()->route('admin.documents.index')->with('success', 'Document deleted successfully.');
    }
}
