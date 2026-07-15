<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FragranceType extends Model
{
    use HasFactory;

    // Nama tabel di database Oracle
    protected $table = 'fragrance_types';
    
    // Beritahu Laravel bahwa Primary Key kita bertipe String (Bukan Auto-Increment Integer)
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang diizinkan untuk diisi massal
    protected $fillable = ['id', 'name', 'slug', 'description'];

    /**
     * Relasi: Satu jenis konsentrasi parfum (EDP/EDT/XDP) dimiliki oleh banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'fragrance_type_id', 'id');
    }
}