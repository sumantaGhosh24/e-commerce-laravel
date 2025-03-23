<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product_attr_id', 'qty', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_attr()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
