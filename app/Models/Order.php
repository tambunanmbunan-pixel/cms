<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'shipping_id',
        'payment_method_id',
        'payment_channel_id',
        'order_number',
        'total_price',
        'shipping_cost',
        'grand_total',
        'status',
        'shipping_address'
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi ke Shipping Ekspedisi
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    // Relasi ke Detail Item Yang Dibeli (One-to-Many)
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // Method Helper Warna Status Badge
    public function getStatusColor()
    {
        return match (strtolower($this->status)) {
            'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-200',
            default => 'bg-amber-100 text-amber-800 border-amber-200', // pending
        };
    }
}