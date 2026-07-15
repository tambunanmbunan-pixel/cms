<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan isi keranjang belanja customer beserta relasi ganda (Product & Bundle)
     */
    public function index()
    {
        // 1. Ambil ID dari customer yang sedang login secara sah
        $userId = Auth::guard('customer')->id() ?? auth()->id();

        // 2. ORA-02291 FIX FOR GUEST: Jika user belum login, jangan dipaksa insert ID dummy 1 ke DB Oracle.
        // Kita langsung buatkan object kosong tiruan agar halaman /cart bisa diakses dengan aman tanpa mental.
        if (!$userId) {
            $cart = new Cart();
            $cart->id = 0;
            $cart->setRelation('items', collect()); // Berikan collection kosong agar loop @foreach di Blade tidak error
            
            return view('front.cart', compact('cart'));
        }

        // 3. Jika user terautentikasi, cari data keranjang belanja asli di database Oracle
        $cart = Cart::with(['items.product.category', 'items.bundle.products'])
                    ->where('user_id', $userId)
                    ->first();

        // Jika user login belum memiliki record keranjang, buat baru secara aman
        if (!$cart) {
            $cart = new Cart();
            $cart->id = rand(10000000, 99999999);
            $cart->user_id = $userId;
            
            try {
                $cart->save();
            } catch (\Exception $e) {
                // Fallback darurat jika save ke DB bermasalah agar user tidak melihat halaman error
                $cart->id = 0;
                $cart->setRelation('items', collect());
            }

            $cart->load(['items.product.category', 'items.bundle.products']);
        }

        return view('front.cart', compact('cart'));
    }

    /**
     * Menambahkan item ke dalam keranjang belanja
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|string|exists:products,id',
            'bundle_id'  => 'nullable|string|exists:product_bundles,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $userId = Auth::guard('customer')->id() ?? auth()->id();
        
        // PENGAMAN JIKA USER GUEST MENAMBAHKAN BARANG: 
        // Arahkan ke halaman login jika guest mencoba melakukan interaksi 'Add to Cart' database
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu untuk mulai berbelanja.'
            ], 401);
        }

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->id = rand(10000000, 99999999);
            $cart->user_id = $userId;
            $cart->save();
        }

        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->where('bundle_id', $request->bundle_id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $request->quantity);
        } else {
            $newItem = new CartItem();
            $newItem->id = rand(10000000, 99999999);
            $newItem->cart_id = $cart->id;
            $newItem->product_id = $request->product_id;
            $newItem->bundle_id = $request->bundle_id;
            $newItem->quantity = $request->quantity;
            $newItem->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil ditambahkan ke keranjang kemewahan Anda!'
        ]);
    }

    /**
     * Mengubah kuantitas item secara dinamis (via AJAX/Request)
     */
    public function updateQuantity(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $action = $request->input('action');

        if ($action === 'increase') {
            $cartItem->increment('quantity');
        } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }

        return redirect()->route('cart.index');
    }

    /**
     * Mengambil jumlah total kuantitas item untuk ditaruh di badge navbar icon
     */
    public function getCartCount()
    {
        $userId = Auth::guard('customer')->id() ?? auth()->id(); 
        
        if (!$userId) {
            return response()->json(['count' => 0]);
        }
        
        $cart = Cart::where('user_id', $userId)->first();
        $count = $cart ? $cart->items()->sum('quantity') : 0;

        return response()->json(['count' => $count]);
    }

    /**
     * Menghapus baris item dari keranjang belanja
     */
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success_message', 'Item berhasil dikeluarkan dari keranjang.');
    }
}