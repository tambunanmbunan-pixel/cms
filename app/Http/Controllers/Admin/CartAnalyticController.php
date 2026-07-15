<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class CartAnalyticController extends Controller
{
    public function index() {
        Session::put('page', 'cart');

        // Mengambil data untuk Analisis
        $carts = Cart::with(['customer', 'items.product'])->latest()->get();
        
        
        // Data untuk Summary Dashboard
        $stats = [
            'total_carts' => Cart::count(),
            'total_items_count' => CartItem::sum('quantity'),
            'carts_with_many_items' => CartItem::where('quantity', '>', 3)->count(),
            'total_users_active' => Cart::distinct('user_id')->count(),
        ];

        return view('admin.carts.index', compact('carts', 'stats'));
    }
}