<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod; // Import model yang benar
use App\Models\PaymentChannel; // Import model yang benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index() {
        Session::put('page', 'payments');

        // Mengambil semua metode beserta channel-nya
        $methods = PaymentMethod::with('channels')->get(); 

        return view('admin.payments.index', compact('methods'));
    }

    // TAMBAHKAN FUNGSI INI
    public function create() {
        // Ambil data metode pembayaran agar bisa dipilih di dropdown form
        $methods = PaymentMethod::all();
        return view('admin.payments.create', compact('methods'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required', 'code' => 'required']);
        Payment::create($request->all());
        return redirect()->route('admin.payments.index')->with('success_message', 'Channel berhasil ditambahkan.');
    }

    public function show($id) {
    $channel = \App\Models\PaymentChannel::findOrFail($id);
    return view('admin.payments.show', compact('channel'));
}

    public function edit($id) {
        $channel = \App\Models\PaymentChannel::findOrFail($id);
        $methods = \App\Models\PaymentMethod::all();
        return view('admin.payments.edit', compact('channel', 'methods'));
    }

    public function update(Request $request, $id) {
        $request->validate(['name' => 'required', 'code' => 'required']);
        $channel = \App\Models\PaymentChannel::findOrFail($id);
        $channel->update($request->all());
        return redirect()->route('payments.index')->with('success_message', 'Channel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari channel berdasarkan ID
        $channel = \App\Models\PaymentChannel::findOrFail($id);
        
        // Hapus
        $channel->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('payments.index')
                        ->with('success_message', 'Channel pembayaran berhasil dihapus!');
    }
}