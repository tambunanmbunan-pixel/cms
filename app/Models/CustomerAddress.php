<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $table = 'customer_addresses';

    protected $fillable = [
        'customer_id',
        'address_label',
        'recipient_name',
        'recipient_phone',
        'full_address',
        'province',
        'city',
        'district',
        'postal_code',
        'is_default',
    ];

    /**
     * Relasi ke Tabel Utama Customers
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}