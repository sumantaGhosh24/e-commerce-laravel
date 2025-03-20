<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $finalResult = [];

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
                    }
                }
            }
        }

        return view('cart', ['cart' => $finalResult]);
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
}