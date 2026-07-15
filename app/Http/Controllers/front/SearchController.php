<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json(['products' => [], 'bundles' => []]);
        }

        // Gunakan LOWER untuk memaksa database MySQL/Oracle mencari tanpa peduli Huruf Besar/Kecil
        $products = Product::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%'])
            ->take(5)
            ->get(['id', 'name', 'slug', 'price', 'stock', 'featured_image']);

        $bundles = [];
        
        // Cek dinamis: apakah model ProductBundle benar-benar ada?
        if (class_exists('App\Models\ProductBundle')) {
            $bundles = \App\Models\ProductBundle::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%'])
                ->take(5)
                ->get(['id', 'name', 'slug', 'price', 'stock', 'image']);
        } 
        // Alternatif jika nama model Anda di folder app/Models adalah "Bundle" bukan "ProductBundle"
        elseif (class_exists('App\Models\Bundle')) {
            $bundles = \App\Models\Bundle::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                ->take(5)
                ->get(['id', 'name', 'slug', 'price', 'stock', 'image']);
        }

        return response()->json([
            'products' => $products,
            'bundles' => $bundles
        ]);
    }
}