<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Wajib import ini untuk Auth
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    // Nama tabel di database Oracle
    protected $table = 'customers';

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'gender',
        'status',
        'email_verified_at',
        'last_login_at',
    ];

    // Menyembunyikan kolom sensitif saat data ditarik
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Menghitung otomatis tipe data date/timestamp
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function addresses() {
        return $this->hasMany(CustomerAddress::class, 'customer_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}