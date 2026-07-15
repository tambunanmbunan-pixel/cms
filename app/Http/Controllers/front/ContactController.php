<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan halaman Kontak
     */
    public function index()
    {
        return view('front.contact');
    }

    /**
     * Menyimpan pesan kiriman dari formulir kontak
     */
    public function store(Request $request)
    {
        // Validasi input formulir
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'subject.required' => 'Subjek pertanyaan wajib dipilih.',
            'message.required' => 'Isi pesan wajib ditulis.',
            'message.min' => 'Pesan minimal berisi 10 karakter.',
        ]);

        // Simpan ke database
        ContactMessage::create($validated);

        // Kembalikan ke halaman kontak dengan membawa pesan sukses
        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}