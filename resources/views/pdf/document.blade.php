<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <style>*, *::before, *::after {margin: 0; padding: 0; box-sizing: border-box;} .flex {display: flex;} .justify-center {justify-content: center;} .items-center {align-items: center;} .bg-white {background-color: #ffffff;} .my-20 {margin-top: 5rem;margin-bottom: 5rem;} .rounded-lg {border-radius: 0.5rem;} .shadow-md {box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);} .p-8 {padding: 2rem;} .shadow-black {box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);} .overflow-y-scroll {overflow-y: scroll;} .text-2xl {font-size: 1.5rem;} .font-bold {font-weight: bold;} .mb-4 {margin-bottom: 1rem;} .min-w-full {min-width: 100%;} .bg-gray-200 {background-color: #e5e7eb;} .text-gray-600 {color: #4b5563;} .text-sm {font-size: 0.875rem;} .leading-normal {line-height: 1.5;} .py-3 {padding-top: 0.37rem;padding-bottom: 0.37rem;} .px-6 {padding-left: 0.75rem;padding-right: 0.75rem;} .text-left {text-align: left;} .uppercase {text-transform: uppercase;} .w-12 {width: 3rem;} .h-12 {height: 3rem;} .rounded-full {border-radius: 9999px;} .mt-5 {margin-top: 1.25rem;}</style>
    </head>
    <body class="bg-white">
        <div class="flex justify-center items-center bg-white my-20">
            <div class="bg-white rounded-lg shadow-md p-8 shadow-black container mx-auto overflow-y-scroll">
                <h2 class="text-2xl font-bold mb-4">Order Details</h2>
                <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <td class="py-3 px-6 text-left">{{ $order->id }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">User Name</th>
                        <td class="py-3 px-6 text-left">{{ $order->user->name }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">User Email</th>
                        <td class="py-3 px-6 text-left">{{ $order->user->email }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Address</th>
                        <td class="py-3 px-6 text-left">{{ $order->address }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">City</th>
                        <td class="py-3 px-6 text-left">{{ $order->city }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Pincode</th>
                        <td class="py-3 px-6 text-left">{{ $order->pincode }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Total Price</th>
                        <td class="py-3 px-6 text-left">{{ $order->total_price }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Net Price</th>
                        <td class="py-3 px-6 text-left">{{ $order->net_price }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Order Status</th>
                        <td class="py-3 px-6 text-left">{{ $order->order_status }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Coupon Value</th>
                        <td class="py-3 px-6 text-left">{{ $order->coupon_value }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Coupon Code</th>
                        <td class="py-3 px-6 text-left">{{ $order->coupon_code }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Payment</th>
                        <td class="py-3 px-6 text-left">{{ $order->paymentResultId }} | {{ $order->paymentResultStatus }} | {{ $order->paymentResultOrderId }} | {{ $order->paymentResultPaymentId }} | {{ $order->paymentResultRazorpaySignature }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Created At</th>
                        <td class="py-3 px-6 text-left">{{ $order->created_at }}</td>
                    </tr>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <td class="py-3 px-6 text-left">{{ $order->updated_at }}</td>
                    </tr>
                </table>
                <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Description</th>
                            <th class="py-3 px-6 text-left">Image</th>
                            <th class="py-3 px-6 text-left">Category</th>
                            <th class="py-3 px-6 text-left">Color</th>
                            <th class="py-3 px-6 text-left">Size</th>
                            <th class="py-3 px-6 text-left">Price</th>
                            <th class="py-3 px-6 text-left">Total Price</th>
                            <th class="py-3 px-6 text-left">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_details as $order_detail)
                            <tr>
                                <td class="py-3 px-6 text-left">{{ $order_detail->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->product->title }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->product->description }}</td>
                                <td class="py-3 px-6 text-left">
                                    <img src="{{ asset('storage/' . $order_detail->product->images->first()->image) }}" alt="product" class="w-12 h-12 rounded-full" />
                                </td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->product->category->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->product_attr->color }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->product_attr->size }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->product_attr->price }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->price }}</td>
                                <td class="py-3 px-6 text-left">{{ $order_detail->qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>