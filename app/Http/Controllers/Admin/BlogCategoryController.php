<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class BlogCategoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori blog
     */
    public function index()
    {
        Session::put('page', 'blog'); // Tambahkan ini
        return redirect()->route('admin.blogs.index');
    }

    public function create()
    {
        return view('admin.blogs.create_categories'); // 👈 Arahkan ke nama file baru
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blogs.edit_categories', compact('category')); // 👈 Arahkan ke nama file baru
    }

    /**
     * Menampilkan detail spesifikasi kategori tertentu beserta relasinya
     */
    public function show($id)
    {
        // Eager load posts untuk menghitung total artikel terkait
        $category = BlogCategory::with('posts')->findOrFail($id);
        return view('admin.blogs.show_categories', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blogs_categories,name',
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        // 🛠️ TRAMBAHKAN ->with('current_tab', 'categories')
        return redirect()->route('blogs.index')
            ->with('success_message', 'Kategori editorial baru berhasil disimpan!')
            ->with('current_tab', 'categories');
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:blogs_categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        // 🛠️ TRAMBAHKAN ->with('current_tab', 'categories')
        return redirect()->route('blogs.index')
            ->with('success_message', 'Nama kategori blog berhasil diperbarui!')
            ->with('current_tab', 'categories');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        
        if ($category->posts()->count() > 0) {
            return redirect()->route('blogs.index')
                ->with('error_message', 'Gagal menghapus! Kategori ini masih terikat dengan beberapa artikel aktif.')
                ->with('current_tab', 'categories'); // 👈 Tetap di tab kategori saat gagal
        }

        $category->delete();
        
        // 🛠️ TRAMBAHKAN ->with('current_tab', 'categories')
        return redirect()->route('blogs.index')
            ->with('success_message', 'Kategori blog berhasil dihapus secara permanen!')
            ->with('current_tab', 'categories');
    }
}