<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\ProductAttributeFactory> */
    use HasFactory;

    protected $fillable = ['size', 'color', 'mrp', 'price', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
