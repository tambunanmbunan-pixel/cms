<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Customer; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    /**
     * Menampilkan Halaman Tunggal Gabungan (Login & Register)
     */
    public function showAuthForm(Request $request)
    {
        // Jika pengguna sudah login, langsung alihkan ke katalog toko
        if (Auth::guard('customer')->check()) {
            return redirect()->route('front.shop');
        }

        // Tangkap URL halaman asal sebelum user mengklik tombol Sign In
        $previousUrl = url()->previous();
        
        // Pastikan URL asal bukan berasal dari halaman auth/login itu sendiri agar tidak berputar (looping)
        if ($previousUrl && !str_contains($previousUrl, '/auth') && !str_contains($previousUrl, '/login')) {
            session(['url.intended' => $previousUrl]);
        }

        return view('front.auth_page');
    }

    /**
     * Memproses Data Registrasi Pengguna Baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar di sistem kami.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'confirm_password.same' => 'Konfirmasi password tidak cocok dengan password utama.',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Active',
        ]);

        // Berikan penanda flash session agar otomatis membuka tab login setelah registrasi
        return redirect()->route('auth')
            ->with('active_tab', 'login')
            ->with('success_register', 'Akun berhasil dibuat! Silakan masukkan email dan password Anda untuk masuk.');
    }

    /**
     * Memproses Autentikasi Login Customer
     */
    public function login(Request $request)
    {
        // 1. Validasi Input Form
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->has('remember');

        // 2. Coba Autentikasi menggunakan guard 'customer'
        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Catat waktu login terakhir
            $customer = Auth::guard('customer')->user();
            $customer->update([
                'last_login_at' => Carbon::now()
            ]);

            // Ambil URL intended, jika kosong arahkan ke rute front.shop
            $redirectUrl = session()->pull('url.intended', route('front.shop'));
            return redirect()->to($redirectUrl)->with('success', 'Selamat datang kembali!');
        }

        // 3. 🚨 FIX: Jika pencocokan akun gagal, kembalikan dengan pesan kesalahan tegas
        return redirect()->route('auth')
            ->withErrors(['login_error' => 'Email atau password yang Anda masukkan salah.'])
            ->with('active_tab', 'login')
            ->withInput($request->only('email'));
    }

    /**
     * Memproses Logout Customer
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.home')->with('success', 'Anda telah berhasil keluar.');
    }
}