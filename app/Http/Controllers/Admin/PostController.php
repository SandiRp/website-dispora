<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('type', 'post')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'status' => 'required|in:draft,published,archived',
            'published_date' => 'nullable|date',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        // Default ke hari ini jika tidak diisi
        if (empty($validated['published_date'])) {
            $validated['published_date'] = now()->toDateString();
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            // Using 'private' folder on local disk (not public)
            $validated['featured_image'] = $request->file('featured_image')->store('private/posts', 'local');
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('type', 'post')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'status' => 'required|in:draft,published,archived',
            'published_date' => 'nullable|date',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('local')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('private/posts', 'local');
        }

        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('local')->delete($post->featured_image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:5120', // max 5MB
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('private/posts', 'local');
            
            $url = route('admin.files.preview', ['folder' => 'posts', 'filename' => basename($path)]);
            
            return response()->json([
                'url' => $url
            ]);
        }

        return response()->json(['error' => ['message' => 'Upload failed.']], 400);
    }
}
