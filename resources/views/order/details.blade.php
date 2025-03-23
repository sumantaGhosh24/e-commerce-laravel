<x-app-layout>
    <x-slot:title>My Order Details</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

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
                    <td class="py-3 px-6 text-left">{{ $order->user->firstName }}</td>
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
            @if ($order->order_status === "complete")
                <a href="{{ route('order.email', ['id' => $order->id]) }}" class="w-fit block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200 mt-5">Send Email</a>
            @endif
        </div>
    </div>
</x-app-layout>