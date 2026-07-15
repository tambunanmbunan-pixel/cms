<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts'; 
    
    protected $fillable = ['user_id', 'customer_id']; 

    // FIXED ORACLE COMPATIBILITY: Matikan auto-increment karena ID dibuat manual via rand()
    public $incrementing = false;

    // Set tipe key menjadi int agar cocok dengan skema tipe data NUMBER di Oracle
    protected $keyType = 'int';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'id');
    }

    public function items() 
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}