<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'carts_items';
    
    protected $fillable = ['cart_id', 'product_id', 'bundle_id', 'quantity'];

    // FIXED ORACLE COMPATIBILITY: Matikan incrementing untuk model item keranjang
    public $incrementing = false;
    protected $keyType = 'int';

    // Relasi ke Produk Biasa
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // Relasi ke Paket Bundle
    public function bundle()
    {
        return $this->belongsTo(ProductBundle::class, 'bundle_id', 'id');
    }
}