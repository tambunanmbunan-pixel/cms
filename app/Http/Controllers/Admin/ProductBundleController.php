<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBundle;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ProductBundleController extends Controller
{
    public function index()
    {
        Session::put('page', 'bundles');
        $bundles = ProductBundle::with('products')->get();
        return view('admin.bundles.index', compact('bundles'));
    }

   public function create()
    {
        // Menggunakan LOWER() untuk menghindari error case-sensitivity murni database Oracle
        $products = \DB::table('products')
            ->whereRaw('LOWER(status) = ?', ['active']) // Menangkap baik 'active', 'Active', maupun 'ACTIVE'
            ->get();

        // Jika Anda menggunakan Model Eloquent, gunakan alternatif ini:
        // $products = \App\Models\Product::whereRaw('LOWER(status) = ?', ['active'])->get();

        return view('admin.bundles.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Upload Gambar Paket jika ada
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = 'bundle_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/images/bundles'), $imageName);
        }

        // Simpan Paket Induk (Slug & ID otomatis diurus boot model lifecycle)
        $bundle = ProductBundle::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'status' => 'active',
            'image' => $imageName,
        ]);

        // Sinkronisasi data ke tabel Pivot Many-to-Many beserta jumlah itemnya
        $syncData = [];
        foreach ($request->products as $productId) {
            $qty = $request->quantities[$productId] ?? 1;
            $syncData[$productId] = ['quantity' => $qty];
        }
        $bundle->products()->sync($syncData);

        return redirect()->route('bundles.index')->with('success_message', 'Paket bundling baru berhasil disimpan ke Oracle!');
    }

    public function show($id)
    {
        // Eager load relasi produk beserta data pivot kuantitas itemnya dari Oracle
        $bundle = ProductBundle::with('products')->findOrFail($id);
        return view('admin.bundles.show', compact('bundle'));
    }

    /**
     * 🛠️ MENAMPILKAN FORM EDIT BUNDLE
     */
    public function edit($id)
    {
        $bundle = ProductBundle::with('products')->findOrFail($id);
        $products = Product::where('status', 'available')->get();
        
        return view('admin.bundles.edit', compact('bundle', 'products'));
    }

    /**
     * 🛠️ PROSES UPDATE DATA BUNDLE DI ORACLE
     */
    public function update(Request $request, $id)
    {
        $bundle = ProductBundle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Penanganan penggantian gambar fisik
        if ($request->hasFile('image')) {
            if (!empty($bundle->image) && file_exists(public_path('admin/images/bundles/' . $bundle->image))) {
                unlink(public_path('admin/images/bundles/' . $bundle->image));
            }
            $imageName = 'bundle_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/images/bundles'), $imageName);
            $bundle->image = $imageName;
        }

        // Update data dasar bundle set
        $bundle->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Sinkronisasi ulang data item produk penyusun pada tabel pivot
        $syncData = [];
        foreach ($request->products as $productId) {
            $qty = $request->quantities[$productId] ?? 1;
            $syncData[$productId] = ['quantity' => $qty];
        }
        $bundle->products()->sync($syncData);

        return redirect()->route('bundles.index')->with('success_message', 'Paket bundling berhasil diperbarui di database Oracle!');
    }

    public function destroy($id)
    {
        $bundle = ProductBundle::findOrFail($id);

        // 1. Hapus berkas gambar fisik dari storage jika ada
        if (!empty($bundle->image) && file_exists(public_path('admin/images/bundles/' . $bundle->image))) {
            unlink(public_path('admin/images/bundles/' . $bundle->image));
        }

        // 2. Lepas relasi Many-to-Many pada tabel pivot bundle_product (Wajib di RDBMS Oracle)
        $bundle->products()->detach();

        // 3. Hapus data induk paket bundling
        $bundle->delete();

        return redirect()->route('bundles.index')->with('success_message', 'Paket bundling berhasil dihapus secara permanen dari Oracle!');
    }
}