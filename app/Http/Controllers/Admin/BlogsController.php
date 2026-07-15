<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class BlogsController extends Controller
{
    public function index()
    {
        Session::put('page', 'blog');
        $blogs = Post::with(['category', 'author'])->orderBy('id', 'desc')->get();
        $categories = BlogCategory::orderBy('id', 'desc')->get(); // 👈 Ambil data kategori juga
        
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name', 'asc')->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blogs_categories,id',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = 'blog_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/images/blogs'), $imageName);
        }

        Post::create([
            'author_id' => auth()->id() ?? 1, // Mengambil ID user login, default ke 1 jika fallback testing
            'blog_category_id' => $request->blog_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::lower(Str::random(5)),
            'content' => $request->content,
            'status' => $request->status,
            'image' => $imageName
        ]);

        return redirect()->route('blogs.index')->with('success_message', 'Artikel baru berhasil diterbitkan!');
    }

    public function show($id)
    {
        $blog = Post::with(['category', 'author'])->findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Post::findOrFail($id);
        $categories = BlogCategory::orderBy('name', 'asc')->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $blog = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blogs_categories,id',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if (!empty($blog->image) && file_exists(public_path('admin/images/blogs/' . $blog->image))) {
                unlink(public_path('admin/images/blogs/' . $blog->image));
            }
            $imageName = 'blog_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/images/blogs'), $imageName);
            $blog->image = $imageName;
        }

        $blog->update([
            'blog_category_id' => $request->blog_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::lower(Str::random(5)),
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('blogs.index')->with('success_message', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $blog = Post::findOrFail($id);

        if (!empty($blog->image) && file_exists(public_path('admin/images/blogs/' . $blog->image))) {
            unlink(public_path('admin/images/blogs/' . $blog->image));
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success_message', 'Artikel berhasil dihapus secara permanen!');
    }
}