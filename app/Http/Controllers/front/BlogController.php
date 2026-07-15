<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil artikel utama (Featured) berdasarkan kolom status
        $featured = Post::with('category')
                        ->where('status', 'featured')
                        ->latest()
                        ->first();

        // 2. Build query untuk grid artikel (hanya yang published atau featured)
        $query = Post::with('category')->whereIn('status', ['published', 'featured']);

        // Filter Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('content', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Filter Kategori berdasarkan ID rujukan migrasi kamu
        if ($request->has('category') && $request->category != '') {
            $query->where('blog_category_id', $request->category);
        }

        // Hindari duplikasi artikel featured di grid utama
        if ($featured) {
            $query->where('id', '!=', $featured->id);
        }

        $articles = $query->latest()->paginate(6)->withQueryString();

        // 3. Ambil data untuk Sidebar
        $recentPosts = Post::whereIn('status', ['published', 'featured'])->latest()->take(3)->get();
        
        // Ambil daftar kategori yang memiliki post
        $categories = BlogCategory::withCount(['posts' => function($q) {
            $q->whereIn('status', ['published', 'featured']);
        }])->get();

        return view('front.blog', compact('featured', 'articles', 'recentPosts', 'categories'));
    }

    public function show($slug)
    {
        $article = Post::with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        return view('front.blog_detail', compact('article'));
    }
}