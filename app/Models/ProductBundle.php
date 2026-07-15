<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductBundle extends Model
{
    use HasFactory;

    protected $table = 'product_bundles';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'slug', 'description', 'price', 'stock', 'status', 'image'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_product', 'bundle_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    protected static function booted()
    {
        static::creating(function ($bundle) {
            if (empty($bundle->id)) {
                $latest = static::orderBy('id', 'desc')->first();
                $number = $latest ? intval(substr($latest->id, 4)) + 1 : 1;
                $bundle->id = 'BND-' . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
            $bundle->slug = Str::slug($bundle->name) . '-' . Str::lower(Str::random(5));
        });
    }
}