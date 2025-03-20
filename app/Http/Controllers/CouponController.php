<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();

        return view('admin.coupon.all', ['coupons' => $coupons]);
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => ['required', 'string', 'lowercase', 'min:3', 'unique:' . Coupon::class],
            'coupon_value' => ['required', 'decimal:2'],
            'coupon_type' => ['required', 'string'],
            'cart_min_value' => ['required', 'decimal:2'],
        ]);

        Coupon::create([
            'coupon_code' => $request->coupon_code,
            'coupon_value' => $request->coupon_value,
            'coupon_type' => $request->coupon_type,
            'cart_min_value' => $request->cart_min_value
        ]);

        return redirect()->route('admin.coupons')->with('message', 'Coupon created successfully!');
    }

    public function edit(string $id)
    {
        $coupon = Coupon::find($id);

        return view('admin.coupon.update', ['coupon' => $coupon]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'coupon_code' => ['required', 'string', 'lowercase', 'min:3', 'unique:' . Coupon::class],
            'coupon_value' => ['required', 'decimal:2'],
            'coupon_type' => ['required', 'string'],
            'cart_min_value' => ['required', 'decimal:2'],
            'status' => ['required', 'string']
        ]);

        $coupon = Coupon::find($id);

        $coupon->update([
            'coupon_code' => $request->coupon_code,
            'coupon_value' => $request->coupon_value,
            'coupon_type' => $request->coupon_type,
            'cart_min_value' => $request->cart_min_value,
            'status' => $request->status
        ]);

        return redirect()->route('admin.coupon.edit', ['id' => $id])->with('message', 'Coupon updated successfully!');
    }

    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);

        $coupon->delete();

        return redirect()->route('admin.coupons')->with('message', 'Coupon deleted successfully!');
    }
}