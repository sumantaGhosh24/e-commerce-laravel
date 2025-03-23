<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $finalResult = [];
        $totalCartValue = 0;
        $totalProducts = 0;

        if (!empty($cart)) {
            foreach ($cart as $product_id => $attributes) {
                foreach ($attributes as $attribute_id => $item) {
                    $productAttribute = ProductAttribute::with(['product', 'product.images'])
                        ->find($attribute_id);

                    if ($productAttribute) {
                        $attribute = [
                            "id" => $productAttribute->id,
                            "product_id" => $productAttribute->product_id,
                            "size" => $productAttribute->size,
                            "color" => $productAttribute->color,
                            "mrp" => $productAttribute->mrp,
                            "price" => $productAttribute->price,
                        ];

                        $productData = [
                            "id" => $productAttribute->product->id,
                            "title" => $productAttribute->product->title,
                            "image" => $productAttribute->product->images->first()?->image,
                        ];

                        $finalResult[] = [
                            "product" => $productData,
                            "attribute" => $attribute,
                            "qty" => $item['qty'],
                        ];

                        $subtotal = $productAttribute->price * $item['qty'];
                        $totalCartValue += $subtotal;
                        $totalProducts += $item['qty'];
                    }
                }
            }
        }

        return view('cart', ['cart' => $finalResult, 'totalCartValue' => $totalCartValue, 'totalProducts' => $totalProducts]);
    }

    public function add(Request $request)
    {
        $product_id = $request->query('product_id');
        $attribute_id = $request->query('attribute_id');
        $quantity = $request->query('quantity');

        if ($quantity < 1) {
            return redirect()->route('cart')->with('message', 'Quantity should be at least 1!');
        }

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $cart[$product_id][$attribute_id]['qty'] = $quantity;

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        return redirect()->route('cart')->with('message', 'Product added to cart!');
    }

    public function remove(Request $request)
    {
        $product_id = $request->query('product_id');
        $attribute_id = $request->query('attribute_id');

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        unset($cart[$product_id][$attribute_id]);
        if (empty($cart[$product_id])) {
            unset($cart[$product_id]);
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        return redirect()->route('cart')->with('message', 'Product removed to cart!');
    }

    public function clear()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $cart = [];

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        return redirect()->route('cart')->with('message', 'Cart cleared!');
    }

    public function verify(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $request->validate([
            'coupon_code' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
        ]);

        $coupon_code = $request->coupon_code;
        $totalCartValue = 0;
        $netPrice = 0;

        if (!empty($cart)) {
            foreach ($cart as $product_id => $attributes) {
                foreach ($attributes as $attribute_id => $item) {
                    $productAttribute = ProductAttribute::with(['product', 'product.images'])
                        ->find($attribute_id);

                    $subtotal = $productAttribute->price * $item['qty'];
                    $totalCartValue += $subtotal;
                    $netPrice += $subtotal;
                }
            }
        }

        $coupon = Coupon::where('coupon_code', $coupon_code)->where('status', 'active')->first();

        if ($coupon) {
            if ($totalCartValue > $coupon->cart_min_value) {
                $netPrice = $coupon->coupon_type == "rupee" ? $netPrice - $coupon->coupon_value : $netPrice * ((100 - $coupon->coupon_value) / 100);

                return redirect()->route('cart')->with('message', 'Coupon code applied!')->with('coupon_code', $coupon_code)->with('net_price', number_format($netPrice, 2, '.', ''));
            } else {
                return redirect()->route('cart')->with('message', 'Cart minimum value is too less!');
            }
        } else {
            return redirect()->route('cart')->with('message', 'Coupon code is not valid!');
        }
    }
}