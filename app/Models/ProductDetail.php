<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'PRODUCT_DETAILS';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $sequence = null;

    protected $fillable = [
        'product_id',
        'top_notes',
        'heart_notes',
        'base_notes',
        'atmospheric_narrative',
        'longevity',
        'concentration',
        'volume',
        'suitable_for'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}