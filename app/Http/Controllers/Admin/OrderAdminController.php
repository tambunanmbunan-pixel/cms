<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class OrderAdminController extends Controller
{
    /**
     * Menampilkan semua daftar transaksi pesanan customer
     */
    public function index()
    {
        Session::put('page', 'orders'); // Tambahkan ini
        $orders = Order::with('customer')->orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail spesifikasi item belanjakan pesanan customer
     */
    public function show($id)
    {
        // Memuat struktur relasi lengkap bersarang (nested relation)
        $order = Order::with(['customer', 'shipping', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Memperbarui status pesanan (Optional untuk manajemen admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success_message', 'Status pemrosesan pesanan berhasil diperbarui!');
    }
}