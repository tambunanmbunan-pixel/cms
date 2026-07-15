<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class ProductController extends Controller
{
    /**
     * Menampilkan katalog produk utama
     */
    public function index()
    {
        Session::put('page', 'products');
        
        // Eager load relasi categories (Many-to-Many) dan detail (One-to-One)
        $products = Product::with(['categories', 'detail'])->get();
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk baru
     */
    public function create()
    {
        Session::put('page', 'products');
        $categories = Category::get(); 
        
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Memproses penyimpanan produk baru ke Oracle beserta Multi-Category & Details
     */
    public function store(Request $request)
    {
        // 1. Bersihkan sisa data kosong dari dropdown dynamic JavaScript
        if ($request->has('category_ids')) {
            $cleanedCategories = array_unique(array_filter($request->category_ids));
            $request->merge(['category_ids' => $cleanedCategories]);
        }

        // 2. Validasi Input Form
        $request->validate([
            'category_ids'   => 'required|array|min:1',
            'category_ids.*' => 'string|exists:CATEGORIES,id',
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'status'         => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'category_ids.required' => 'Wajib memilih minimal satu kategori produk.',
            'category_ids.*.exists' => 'Kategori yang dipilih tidak valid di database Oracle.'
        ]);

        try {
            // 3. Simpan ke Tabel Induk (PRODUCTS)
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->status = $request->status;

            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                if ($image->isValid()) {
                    $ext = $image->getClientOriginalExtension();
                    $filename = 'prd-' . rand(111, 99999) . '.' . $ext;
                    $image->move(public_path('admin/images/products'), $filename);
                    $product->featured_image = $filename;
                }
            }

            // Simpan master produk untuk memicu Boot Alphanumeric ID (prd-xx)
            $product->save();

            // 4. IKAT MULTI-CATEGORY: Memasukkan relasi ke tabel jembatan 'tags_category'
            $product->categories()->attach($request->category_ids);

            // 5. Simpan ke Tabel Anak (PRODUCT_DETAILS) untuk Olfactory Journey
            ProductDetail::create([
                'product_id'            => $product->id,
                'top_notes'             => $request->top_notes,
                'heart_notes'           => $request->heart_notes,
                'base_notes'            => $request->base_notes,
                'atmospheric_narrative' => $request->atmospheric_narrative,
                'longevity'             => $request->longevity,
                'concentration'         => $request->concentration,
                'volume'                => $request->volume,
                'suitable_for'          => $request->suitable_for,
            ]);

            return redirect()->route('products.index')->with('success_message', 'Produk parfum mewah berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal menyimpan ke Oracle: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan form edit data berdasarkan ID spesifik
     */
    public function edit($id)
    {
        Session::put('page', 'products');
        
        // Mengamankan pencarian ID case-transparent untuk Driver Oracle
        $product = Product::with(['categories', 'detail'])->where('id', $id)->orWhere('ID', $id)->firstOrFail();
        $categories = Category::get();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memproses pembaruan perubahan data produk
     */
    public function update(Request $request, $id)
    {
        // 1. Saring array dari dropdown dinamis JavaScript
        if ($request->has('category_ids')) {
            $cleanedCategories = array_unique(array_filter($request->category_ids));
            $request->merge(['category_ids' => $cleanedCategories]);
        }

        // 2. Validasi Perubahan Data
        $request->validate([
            'category_ids'   => 'required|array|min:1',
            'category_ids.*' => 'string|exists:CATEGORIES,id',
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'status'         => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product = Product::where('id', $id)->orWhere('ID', $id)->firstOrFail();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->status = $request->status;

            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                if ($image->isValid()) {
                    // Bersihkan berkas fisik lama agar local storage rapi
                    if (!empty($product->featured_image) && file_exists(public_path('admin/images/products/' . $product->featured_image))) {
                        unlink(public_path('admin/images/products/' . $product->featured_image));
                    }
                    $ext = $image->getClientOriginalExtension();
                    $filename = 'prd-' . rand(111, 99999) . '.' . $ext;
                    $image->move(public_path('admin/images/products'), $filename);
                    $product->featured_image = $filename;
                }
            }
            
            $product->save();

            // 3. RE-SINKRONISASI PIVOT: Menggunakan sync() agar data lama diganti data baru secara mutakhir
            $product->categories()->sync($request->category_ids);

            // 4. Perbarui data tabel anak (Product Detail) secara fleksibel
            ProductDetail::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'top_notes'             => $request->top_notes,
                    'heart_notes'           => $request->heart_notes,
                    'base_notes'            => $request->base_notes,
                    'atmospheric_narrative' => $request->atmospheric_narrative,
                    'longevity'             => $request->longevity,
                    'concentration'         => $request->concentration,
                    'volume'                => $request->volume,
                    'suitable_for'          => $request->suitable_for,
                ]
            );

            return redirect()->route('products.index')->with('success_message', 'Data produk parfum berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal memperbarui database Oracle: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan detail informasi lengkap produk tertentu
     */
    public function show($id)
    {
        Session::put('page', 'products');
        
        // Eager load categories dan detail secara transparan aman dari glitch kapitalisasi Oracle
        $product = Product::with(['categories', 'detail'])->where('id', $id)->orWhere('ID', $id)->firstOrFail();
        $categories = Category::get();

        return view('admin.products.show', compact('product', 'categories'));
    }
    

    /**
     * Menghapus records produk
     */
    public function destroy($id)
    {
        try {
            $product = Product::where('id', $id)->orWhere('ID', $id)->firstOrFail();
            
            if (!empty($product->featured_image) && file_exists(public_path('admin/images/products/' . $product->featured_image))) {
                unlink(public_path('admin/images/products/' . $product->featured_image));
            }

            // Aturan cascade foreign key di Oracle akan menghapus detail & tags_category secara otomatis
            Product::where('id', $id)->orWhere('ID', $id)->delete();

            return redirect()->route('products.index')->with('success_message', 'Produk berhasil dihapus dari sistem.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}