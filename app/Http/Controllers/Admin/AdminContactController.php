<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminContactController extends Controller
{
    // Fungsi index ini yang dicari oleh Route::resource
    public function index()
    {
        Session::put('page', 'contact'); // Tambahkan ini (sesuaikan dengan nama di sidebar)
        $messages = ContactMessage::latest()->get();
        return view('admin.contactmessages.index', compact('messages'));
    }

    // Fungsi show ini yang dicari oleh Route::resource
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.contactmessages.show', compact('message'));
    }

    // Fungsi reply ini dipanggil oleh rute manual kita
    public function reply(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string']);
        
        $message = ContactMessage::findOrFail($id);
        $message->update([
            'reply' => $request->reply,
            'replied_at' => now(),
        ]);

        return redirect()->route('admin.contacts.show', $id)
                         ->with('success', 'Pesan berhasil dibalas.');
    }
}