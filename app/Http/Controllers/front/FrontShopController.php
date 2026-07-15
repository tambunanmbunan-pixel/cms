<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductBundle;
use App\Models\FragranceType;
use Illuminate\Http\Request;

class FrontShopController extends Controller
{
    /**
     * Halaman Shop
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $fragranceTypes = FragranceType::all();

        $query = Product::with([
            'categories',
            'fragranceType'
        ])->where('status', 'Active');

        /**
         * Filter Category (Many To Many)
         */
        if ($request->filled('categories') && is_array($request->categories)) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->categories);
            });
        }

        /**
         * Filter Fragrance Type
         */
        if ($request->filled('types') && is_array($request->types)) {
            $query->whereIn('fragrance_type_id', $request->types);
        }

        /**
         * Sorting
         */
        switch ($request->sort) {
            case 'newest':
                $query->latest('created_at');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest('created_at');
                break;
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('front.shop', compact('products', 'categories', 'fragranceTypes'));
    }

    /**
     * Detail Product
     */
    public function detail($slug)
    {
        $product = Product::with([
            'categories',
            'detail',
            'fragranceType'
        ])
        ->where('slug', $slug)
        ->where('status', 'Active')
        ->firstOrFail();

        return view('front.product_detail', [
            'product' => $product,
            'isBundle' => false
        ]);
    }

    /**
     * Halaman List Bundle Konsumen (FIXED: Method bundles() telah diisi kembali)
     */
    public function bundles()
    {
        $bundles = ProductBundle::with('products')
            ->where('status', 'Active')
            ->orderBy('id', 'asc')
            ->get();

        return view('front.bundles', compact('bundles'));
    }

    /**
     * Detail Bundle
     */
    public function bundleDetail($slug)
    {
        $bundle = ProductBundle::with('products')
            ->where('slug', $slug)
            ->where('status', 'Active')
            ->firstOrFail();

        return view('front.product_detail', [
            'bundle' => $bundle,
            'isBundle' => true
        ]);
    }
}