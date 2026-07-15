<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard Profil Bento Box Customer
     */
    public function profile()
    {
        // Ambil customer aktif bersama data relasi alamatnya
        $customer = Auth::guard('customer')->user();
        $addresses = $customer->addresses()->orderBy('is_default', 'desc')->get();

        return view('front.profile.index', compact('customer', 'addresses'));
    }

    /**
     * Menampilkan Halaman Form Tambah Alamat Baru
     */
    public function createAddress()
    {
        return view('front.profile.address_create');
    }

    /**
     * Menampilkan Detail Eksklusif Satu Alamat (Show)
     */
    public function showAddress($id)
    {
        // Ambil data menggunakan findOrFail agar aman dari ID manipulasi
        $address = CustomerAddress::findOrFail($id);

        // Proteksi Keamanan: Gunakan != (bukan !==) untuk menghindari konflik tipe data string vs int di Oracle
        if ($address->customer_id != Auth::guard('customer')->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('front.profile.address_show', compact('address'));
    }

    /**
     * Memproses Penyimpanan Alamat Baru ke Database
     */
   public function storeAddress(Request $request)
    {
        $customerId = Auth::guard('customer')->id();

        // 1. Validasi Input Data Form sesuai Skema Migrasi
        $request->validate([
            'address_label'   => 'required|string|max:50',
            'recipient_name'  => 'nullable|string|max:255',
            'recipient_phone' => 'nullable|string|max:20',
            'full_address'    => 'required|string',
            'province'        => 'required|string|max:100',
            'city'            => 'required|string|max:100',
            'district'        => 'nullable|string|max:100',
            'postal_code'     => 'required|string|max:10',
        ], [
            'address_label.required' => 'Label alamat (e.g., Rumah, Kantor) wajib diisi.',
            'full_address.required'  => 'Detail alamat jalan & nomor rumah wajib diisi.',
            'province.required'      => 'Provinsi wajib diisi.',
            'city.required'          => 'Kota/Kabupaten wajib diisi.',
            'postal_code.required'   => 'Kode pos wajib diisi.',
        ]);

        // 2. Jaring Pengaman Alamat Utama (is_default)
        $hasExistingAddress = CustomerAddress::where('customer_id', $customerId)->exists();
        $isDefault = !$hasExistingAddress;

        if ($request->has('is_default') && $request->is_default) {
            CustomerAddress::where('customer_id', $customerId)->update(['is_default' => false]);
            $isDefault = true;
        }

        // 3. Eksekusi Penyimpanan ke Database
        CustomerAddress::create([
            'customer_id'     => $customerId,
            'address_label'   => $request->address_label,
            'recipient_name'  => $request->recipient_name ?? Auth::guard('customer')->user()->name,
            'recipient_phone' => $request->recipient_phone,
            'full_address'    => $request->full_address,
            'province'        => $request->province,
            'city'            => $request->city,
            'district'        => $request->district,
            'postal_code'     => $request->postal_code,
            'is_default'      => $isDefault,
        ]);
        
        // FIX: PENGECEKAN DINAMIS ALUR PENGALIHAN
        if ($request->input('redirect') === 'checkout') {
            return redirect()->route('front.transaction.create', [
                'order_id' => rand(1000, 9999),
                'pid' => $request->input('pid'),
                'qty' => $request->input('qty')
            ])->with('success', 'Alamat baru berhasil ditambahkan ke checkout.');
        }

        // Jalur kembali normal (dari setting profile)
        return redirect()->route('front.profile')->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan Halaman Form Edit Alamat
     */
    public function editAddress($id)
    {
        $address = CustomerAddress::findOrFail($id);

        if ($address->customer_id != Auth::guard('customer')->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('front.profile.address_edit', compact('address'));
    }

    /**
     * Memproses Perubahan / Update Alamat ke Database
     */
    public function updateAddress(Request $request, $id)
    {
        $address = CustomerAddress::findOrFail($id);

        if ($address->customer_id != Auth::guard('customer')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi input data modifikasi alamat
        $request->validate([
            'address_label'   => 'required|string|max:50',
            'recipient_name'  => 'nullable|string|max:255',
            'recipient_phone' => 'nullable|string|max:20',
            'full_address'    => 'required|string',
            'province'        => 'required|string|max:100',
            'city'            => 'required|string|max:100',
            'district'        => 'nullable|string|max:100',
            'postal_code'     => 'required|string|max:10',
        ], [
            'address_label.required' => 'Label alamat wajib diisi.',
            'full_address.required'  => 'Detail jalan alamat wajib diisi.',
            'province.required'      => 'Provinsi wajib diisi.',
            'city.required'          => 'Kota/Kabupaten wajib diisi.',
            'postal_code.required'   => 'Kode pos wajib diisi.',
        ]);

        $isDefault = $address->is_default;

        // Atur ulang flag default jika opsi ini dicentang oleh user
        if ($request->has('is_default') && $request->is_default) {
            CustomerAddress::where('customer_id', Auth::guard('customer')->id())->update(['is_default' => false]);
            $isDefault = true;
        }

        $address->update([
            'address_label'   => $request->address_label,
            'recipient_name'  => $request->recipient_name ?? Auth::guard('customer')->user()->name,
            'recipient_phone' => $request->recipient_phone,
            'full_address'    => $request->full_address,
            'province'        => $request->province,
            'city'            => $request->city,
            'district'        => $request->district,
            'postal_code'     => $request->postal_code,
            'is_default'      => $isDefault,
        ]);

        // FIX: Redirect diarahkan ke rute dashboard profil yang valid (front.profile)
        return redirect()->route('front.profile')->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Menghapus Alamat dari Database
     */
    public function destroyAddress($id)
    {
        $address = CustomerAddress::findOrFail($id);

        if ($address->customer_id != Auth::guard('customer')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $wasDefault = $address->is_default;
        $address->delete();

        if ($wasDefault) {
            $nextAddress = CustomerAddress::where('customer_id', Auth::guard('customer')->id())->first();
            if ($nextAddress) {
                $nextAddress->update(['is_default' => true]);
            }
        }

        return redirect()->route('front.profile')->with('success', 'Alamat berhasil dihapus.');
    }


    /**
     * INDEX: Menampilkan Semua Riwayat Transaksi Pembayaran Customer
     */
    public function indexPayment()
    {
        $customer = Auth::guard('customer')->user();
        
        // Data dummy daftar riwayat pembayaran (Meniru skema decimal 12,2)
        $payments = [
            (object)[
                'id' => 1,
                'order_id' => 101,
                'payment_method' => 'Midtrans',
                'payment_channel' => 'BCA Virtual Account',
                'amount' => 375000.00,
                'payment_status' => 'settlement',
                'created_at' => now()->minusDays(2)
            ],
            (object)[
                'id' => 2,
                'order_id' => 102,
                'payment_method' => 'Manual',
                'payment_channel' => 'Transfer Bank Mandiri',
                'amount' => 520000.00,
                'payment_status' => 'pending',
                'created_at' => now()
            ]
        ];

        return view('front.payment.index', compact('payments'));
    }

    /**
     * CREATE: Halaman Formulir Pemilihan Metode Pembayaran Pertama Kali
     */
    public function createPayment($order_id)
    {
        $order = (object) [
            'id' => $order_id,
            'order_number' => 'INV-' . date('Ymd') . '-' . str_pad($order_id, 4, '0', STR_PAD_LEFT),
            'total_amount' => 375000.00,
            'status' => 'pending'
        ];

        return view('front.payment.create', compact('order'));
    }

    /**
     * STORE: Memproses Submit Pilihan Metode Pembayaran
     */
    public function storePayment(Request $request, $order_id)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Simulasi ID pembayaran baru setelah insert ke Oracle
        $newPaymentId = rand(10, 99); 

        // Alihkan langsung ke halaman SHOW instruksi pembayaran detail
        return redirect()->route('front.payment.show', $newPaymentId)->with('success', 'Metode pembayaran berhasil dipilih.');
    }

    /**
     * SHOW: Menampilkan Struktur Detail Instruksi Bayar Satu Transaksi
     */
    public function showPayment($id)
    {
        // Simulasi pencarian data pembayaran spesifik
        $payment = (object) [
            'id' => $id,
            'order_id' => 102,
            'order_number' => 'INV-202606-0102',
            'payment_method' => 'Manual',
            'payment_channel' => 'Transfer Bank Mandiri',
            'amount' => 375000.00,
            'payment_status' => 'pending',
            'transaction_id' => 'TX-HANAH-' . time(),
        ];

        return view('front.payment.show', compact('payment'));
    }

    /**
     * DELETE (DESTROY): Membatalkan/Menghapus Transaksi Pembayaran yang Masih Pending
     */
    public function destroyPayment($id)
    {
        // Logika penghapusan atau pembatalan di Oracle dilakukan di sini
        
        return redirect()->route('front.payment.index')->with('success', 'Transaksi pembayaran berhasil dibatalkan.');
    }
}