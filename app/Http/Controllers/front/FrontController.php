<?php

namespace App\Http\Controllers\Front; 

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    /**
     * Menampilkan Halaman Utama Front-End (home.blade.php)
     */
    public function home()
    {
        // 1. Ambil 6 produk unggulan terbaru
        $featuredProducts = Product::where('status', 'active')
                                   ->latest()
                                   ->take(6)
                                   ->get();

        // 2. QUERY BEST SELLERS: Menggabungkan ORDERS_ITEMS untuk menghitung total penjualan
        // Menggunakan Query Builder DB murni agar aman dari masalah kapitalisasi nama kolom Oracle
        $bestSellers = DB::table('orders_items')
            ->join('products', 'orders_items.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.slug',
                'products.featured_image',
                DB::raw('SUM(orders_items.quantity) as total_sold')
            )
            ->groupBy('products.id', 'products.name', 'products.price', 'products.slug', 'products.featured_image')
            ->orderBy('total_sold', 'desc')
            ->take(3)
            ->get();

        // FALLBACK: Jika tabel transaksi orders_items masih kosong (belum ada penjualan),
        // ambil 3 produk random/teratas sebagai pajangan awal best seller agar halaman tidak kosong
        if ($bestSellers->isEmpty()) {
            $bestSellers = DB::table('products')
                ->where('status', 'active')
                ->take(3)
                ->get();
        }

        // 3. QUERY NEW ARRIVALS: Ambil 3 produk paling gres berdasarkan tanggal dibuat
        $newArrivals = DB::table('products')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Kirim semua variabel ke view home
        return view('front.home', compact('featuredProducts', 'bestSellers', 'newArrivals'));
    }

    /**
     * Menampilkan Halaman Katalog Toko Penuh (shop.blade.php)
     */
    public function shop()
    {
        $products = Product::where('status', 'active')
                           ->latest()
                           ->paginate(12);

        return view('front.shop', compact('products'));
    }

    /**
     * Menampilkan Detail Produk
     */
    public function productDetail($id)
    {
        $product = Product::where('status', 'active')->findOrFail($id);
        return view('front.product_detail', compact('product'));
    }

    /**
     * Menampilkan Halaman Bundles
     */
    public function bundles()
    {
        $bundles = DB::table('product_bundles')
            ->where('status', 'active')
            ->orderBy('id', 'asc')
            ->get();

        return view('front.bundles', compact('bundles'));
    }
}