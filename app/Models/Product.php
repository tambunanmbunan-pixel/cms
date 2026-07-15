<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = 'PRODUCTS';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $sequence = null; 

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'status',
        'featured_image'
    ];

    // Relasi ke Tabel Kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relasi One-to-One ke Detail Spek Aroma Parfum
    public function detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'id');
    }

    public function categories()
    {
        // Mengunci nama tabel jembatan ke 'tags_category'
        return $this->belongsToMany(Category::class, 'tags_category', 'product_id', 'category_id');
    }

    public function fragranceType()
    {
        return $this->belongsTo(FragranceType::class, 'fragrance_type_id', 'id');
    }

    public function bundles()
    {
        return $this->belongsToMany(ProductBundle::class, 'bundle_product', 'product_id', 'bundle_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    /**
     * Otomatisasi Alphanumeric ID PROD-01, PROD-02, dst. & Auto-Slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // 1. AMANKAN SLUG: Otomatis isi jika slug kosong saat disubmit lewat seeder / form admin
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }

            // 2. GENERATOR ALPHANUMERIC ID ORACLE (Format: PROD-XX)
            if (empty($model->id)) {
                // SINKRONISASI ORACLE: Mengambil nomor setelah string 'PROD-' (karakter ke-6 di Oracle SQL)
                $latestProduct = self::orderByRaw('CAST(SUBSTR(id, 6) AS INT) DESC')->first();

                if (!$latestProduct) {
                    $model->id = 'PROD-01';
                } else {
                    // Di PHP, substring diambil dari index ke-5 untuk string 'PROD-'
                    $number = (int) substr($latestProduct->id, 5);
                    $model->id = 'PROD-' . sprintf('%02d', $number + 1);
                }
            }
            
            // Pengaman tambahan: pastikan ID dipaksa uppercase agar serasi di Oracle
            $model->id = strtoupper($model->id);
        });
    }
}