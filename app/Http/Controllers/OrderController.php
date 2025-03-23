<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductAttribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Razorpay\Api\Payment;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'min:3', 'max:150'],
            'city' => ['required', 'string', 'min:3', 'max:150'],
            'pincode' => ['required', 'string', 'min:3', 'max:150'],
        ]);

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $coupon_code = $request->query('coupon_code');
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

                $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

                $order = $api->order->create([
                    'receipt' => uniqid(),
                    'amount' => intval(round($netPrice * 100)),
                    'currency' => 'INR',
                    'payment_capture' => 1
                ]);

                return view('order-success', [
                    'order_id' => $order['id'],
                    'amount' => intval(round($netPrice * 100)),
                    'key' => env('RAZORPAY_KEY_ID'),
                    'address' => $request->address,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'coupon_code' => $request->query('coupon_code')
                ]);
            } else {
                $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

                $order = $api->order->create([
                    'receipt' => uniqid(),
                    'amount' => intval(round($netPrice * 100)),
                    'currency' => 'INR',
                    'payment_capture' => 1
                ]);

                return view('order-success', [
                    'order_id' => $order['id'],
                    'amount' => intval(round($netPrice * 100)),
                    'key' => env('RAZORPAY_KEY_ID'),
                    'address' => $request->address,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'coupon_code' => $request->query('coupon_code')
                ]);
            }
        } else {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $order = $api->order->create([
                'receipt' => uniqid(),
                'amount' => intval(round($netPrice * 100)),
                'currency' => 'INR',
                'payment_capture' => 1
            ]);

            return view('order-success', [
                'order_id' => $order['id'],
                'amount' => intval(round($netPrice * 100)),
                'key' => env('RAZORPAY_KEY_ID'),
                'address' => $request->address,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'coupon_code' => $request->query('coupon_code')
            ]);
        }
    }

    public function store(Request $request)
    {
        if (!$request->has('razorpay_payment_id')) {
            return redirect()->route('donate')->with('message', 'Order Failed!');
        }

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $coupon = Coupon::where('coupon_code', $request->query('coupon_code'))->where('status', 'active')->first();

        $cart = json_decode(Cookie::get('cart', '[]'), true);

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

        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            if ($payment->status == "captured") {
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'address' => $request->query('address'),
                    'city' => $request->query('city'),
                    'pincode' => $request->query('pincode'),
                    'order_status' => 'pending',
                    'coupon_id' => $coupon->id ?? 0,
                    'coupon_value' => $coupon->coupon_value ?? "none",
                    'coupon_code' => $coupon->coupon_code ?? "none",
                    'total_price' => $totalCartValue,
                    'net_price' => $payment->amount / 100,
                    'paymentResultId' => $payment->id,
                    'paymentResultStatus' => $payment->status,
                    'paymentResultOrderId' => $payment->order_id ?? "none",
                    'paymentResultPaymentId' => $payment->id,
                    'paymentResultRazorpaySignature' => $request->razorpay_signature ?? "none",
                ]);

                if (!empty($cart)) {
                    foreach ($cart as $product_id => $attributes) {
                        foreach ($attributes as $attribute_id => $item) {
                            $productAttribute = ProductAttribute::with(['product', 'product.images'])
                                ->find($attribute_id);

                            OrderDetail::create([
                                'order_id' => $order->id,
                                'product_id' => $productAttribute->product_id,
                                'product_attr_id' => $productAttribute->id,
                                'qty' => $item['qty'],
                                'price' => $productAttribute->price * $item['qty']
                            ]);
                        }
                    }
                }

                $cart = [];

                Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

                return redirect()->route('cart')->with('message', 'Order Success!');
            } else {
                return redirect()->route('cart')->with('message', 'Order Failed!');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('message', 'Order Failed!');
        }
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('order.all', ['orders' => $orders]);
    }

    public function myOrder(string $id)
    {
        $order = Order::find($id);

        return view('order.details', ['order' => $order]);
    }

    public function sendEmail(string $id)
    {
        $order = Order::find($id);

        $details = [
            'email' => $order->user->email,
            'subject' => 'Order Information',
            'message' => '',
            'order' => $order
        ];

        Mail::to($details['email'])->send(new OrderMail($details));

        return redirect()->route('order', ['id' => $id])->with('message', 'Email sent successfully!');
    }

    public function index()
    {
        $orders = Order::all();

        return view('admin.order.all', ['orders' => $orders]);
    }

    public function edit(string $id)
    {
        $order = Order::find($id);

        return view('admin.order.update', ['order' => $order]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_status' => ['required', 'string']
        ]);

        $order = Order::find($id);

        $order->update(['order_status' => $request->order_status]);

        return redirect()->route('admin.order.edit', ['id' => $id])->with('message', 'Order updated successfully!');
    }
}