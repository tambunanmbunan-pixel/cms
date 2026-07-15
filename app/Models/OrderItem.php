<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Sesuai dengan nama skema migrasi Anda: orders_items
    protected $table = 'orders_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_at_purchase'
    ];

    // Relasi ke Induk Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relasi ke Produk Retail (menggunakan key string 10 digit sesuai migrasi Anda)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}