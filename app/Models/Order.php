<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['address', 'city', 'pincode', 'coupon_value', 'coupon_code', 'total_price', 'net_price', 'paymentResultId', 'paymentResultStatus', 'paymentResultOrderId', 'paymentResultPaymentId', 'paymentResultRazorpaySignature', 'coupon_id', 'order_status', 'user_id'];

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
