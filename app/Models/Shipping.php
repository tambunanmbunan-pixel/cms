<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shippings';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'courier_name',
        'service_name',
        'cost',
        'estimated_time',
        'status'
    ];

    // Cast data tipe cost ke format numeric otomatis
    protected $casts = [
        'cost' => 'decimal:2',
    ];
}