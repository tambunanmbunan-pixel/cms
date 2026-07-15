<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    // Jika tabel Anda bernama 'payment_methods' di database, 
    // Anda tidak perlu menuliskan protected $table lagi.
    protected $fillable = ['name', 'code', 'status'];

    public function channels() {
        // Asumsi: satu metode pembayaran punya banyak channel
        return $this->hasMany(PaymentChannel::class);
    }
}