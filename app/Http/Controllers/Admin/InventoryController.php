<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            View::share('products', Product::all());
            View::share('bundles', ProductBundle::with('products')->get());
            return $next($request);
        });
    }

    public function index() {
    Session::put('page', 'inventory'); // <--- PENTING: Tambahkan ini
    return view('admin.inventory.index');
}

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('admin.inventory.show', compact('product'));
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.inventory.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $request->validate(['stock' => 'required|integer|min:0']);
        $product = Product::findOrFail($id);
        $product->update(['stock' => $request->stock]);
        return redirect()->route('inventory.index')->with('success_message', 'Stok berhasil diperbarui.');
    }
}