<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // 1. Definisikan nama tabel secara eksplisit (PENTING untuk Oracle)
    protected $table = 'ADMINS';

    // 2. Tentukan kolom apa saja yang bisa diisi
    protected $fillable = [
        'name', 'email', 'password', 'status', 'role', 'mobile',
    ];

    // 3. Tentukan kolom yang harus disembunyikan (keamanan)
    protected $hidden = [
        'password',
    ];

    // 4. Pastikan cast data (opsional, tapi disarankan)
    // protected $casts = [
    //     'password' => 'hashed',
    // ];
}