<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'CATEGORIES'; // Sesuaikan kapitalisasi tabel Oracle kamu

    protected $primaryKey = 'id'; // atau 'ID' sesuai migrasinya

    // 1. MATIKAN auto-increment bawaan karena primary key berbentuk String
    public $incrementing = false;

    // 2. Tegaskan tipe key adalah string
    protected $keyType = 'string';

    // 3. KUNCI UTAMA SINKRONISASI ORACLE: Matikan pencarian sequence otomatis bawaan Yajra
    public $sequence = null; 

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'category_image',
    ];

    public function products()
    {
        // Mengunci nama tabel jembatan ke 'tags_category'
        return $this->belongsToMany(Product::class, 'tags_category', 'category_id', 'product_id');
    }

    /**
     * Otomatisasi generate kode urut cat-01 jika id kosong saat input baru
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Jika ID tidak diisi manual (seperti di form store biasa), generate otomatis
            if (empty($model->id)) {
                $latestCategory = self::orderByRaw('CAST(SUBSTR(id, 5) AS INT) DESC')->first();

                if (!$latestCategory) {
                    $model->id = 'cat-01';
                } else {
                    $latestId = $latestCategory->id; 
                    $number = (int) substr($latestId, 4);
                    $nextNumber = $number + 1;
                    $model->id = 'cat-' . sprintf('%02d', $nextNumber);
                }
            }
        });
    }
}