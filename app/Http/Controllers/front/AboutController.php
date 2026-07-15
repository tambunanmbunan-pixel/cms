<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Menampilkan halaman About Us eksklusif Hanah.
     */
    public function index()
    {
        // Mengarahkan ke file view front/about.blade.php
        return view('front.about');
    }
}