<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str; // <-- KUNCINYA DI SINI! Sekarang sudah ditambahkan

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'categories');
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Session::put('page', 'categories');
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|unique:CATEGORIES,SLUG', 
        ], [
            'category_slug.unique' => 'Slug URL kategori ini sudah digunakan!',
        ]);

        try {
            $category = new Category();
            $category->name = $request->category_name;
            $category->slug = $request->category_slug;
            $category->save();

            return redirect()->route('categories.index')->with('success_message', 'Kategori baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal menyimpan ke Oracle: ' . $e->getMessage())->withInput();
        }
    }

 /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Session::put('page', 'categories');
        $category = Category::findOrFail($id); // <-- Hasil query Oracle disimpan di sini
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Aturan Validasi Ketat
        $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'category_image.image' => 'Berkas berkewajiban berupa format file gambar.',
            'category_image.max'   => 'Ukuran gambar maksimal tidak boleh melebihi 2MB.'
        ]);

        try {
            // Perbaikan Mutlak Oracle: Cari menggunakan where yang mencakup id kecil atau ID besar
            $category = Category::where('id', $id)->orWhere('ID', $id)->firstOrFail();
            
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->description = $request->description;

            // 2. Pemrosesan Upload Gambar Kategori Baru
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    
                    // Bersihkan file gambar lama di storage jika datanya ada
                    if (!empty($category->category_image) && file_exists(public_path('admin/images/categories/' . $category->category_image))) {
                        unlink(public_path('admin/images/categories/' . $category->category_image));
                    }
                    
                    // Buat penamaan acak baru untuk file gambar
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_name = 'cat-' . rand(111, 99999) . '.' . $extension;
                    
                    // Pindahkan file ke direktori public asset
                    $image_tmp->move(public_path('admin/images/categories'), $image_name);
                    $category->category_image = $image_name;
                }
            }

            // PERBAIKAN UTAMA: Jika $category->save() gagal karena glitch Primary Key Oracle, 
            // kita paksa update menggunakan query builder murni Eloquent.
            Category::where('id', $id)->orWhere('ID', $id)->update([
                'name'           => $category->name,
                'slug'           => $category->slug,
                'description'    => $category->description,
                'category_image' => $category->category_image
            ]);

            return redirect()->route('categories.index')->with('success_message', 'Kategori produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal memperbarui database Oracle: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        Session::put('page', 'categories');
        
        // Mengirimkan data kategori ke halaman detail
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // 1. Cari data kategori terlebih dahulu untuk menghapus gambar fisiknya
            $category = Category::where('id', $id)->orWhere('ID', $id)->first();

            if ($category) {
                // Hapus gambar kategori dari folder public jika ada
                if (!empty($category->category_image) && file_exists(public_path('admin/images/categories/' . $category->category_image))) {
                    unlink(public_path('admin/images/categories/' . $category->category_image));
                }
            }

            // 2. PERBAIKAN MUTLAK ORACLE: Paksa delete menggunakan Query Builder murni
            // Ini akan mem-bypass masalah case-sensitivity primary key pada model Eloquent
            Category::where('id', $id)->orWhere('ID', $id)->delete();

            return redirect()->route('categories.index')->with('success_message', 'Kategori produk berhasil dihapus secara permanen!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal menghapus data dari database Oracle: ' . $e->getMessage());
        }
    }
}