<x-app-layout>
    <x-slot:title>Cart</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen pt-8 bg-white container mx-auto">
        <div class="flex items-start justify-between flex-wrap gap-3 flex-row">
            <div class="overflow-x-scroll w-full">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold">My Cart</h2>
                    @if ($cart)
                        <form class="flex items-center gap-1.5" method="POST" action="{{ route('cart.clear') }}">
                            @csrf

                            <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Clear</button>
                        </form>
                    @endif
                </div>
                @if ($cart)
                    <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Title</th>
                                <th class="py-3 px-6 text-left">Size/Color</th>
                                <th class="py-3 px-6 text-left">Image</th>
                                <th class="py-3 px-6 text-left">Quantity</th>
                                <th class="py-3 px-6 text-left">Add</th>
                                <th class="py-3 px-6 text-left">Remove</th>
                                <th class="py-3 px-6 text-left">Delete</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $product)
                                <tr>
                                    <td class="py-3 px-6 text-left">{{ $product['product']['title'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $product['attribute']['size'] }} / {{ $product['attribute']['color'] }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <img src="{{ asset('storage/' . $product['product']['image']) }}" alt="product" class="h-16 w-16 rounded-full" />
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $product['qty'] }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <form class="flex items-center gap-1.5" method="POST" action="{{ route('cart.add', ['product_id' => $product['product']['id'], 'attribute_id' => $product['attribute']['id'], 'quantity' => $product['qty'] + 1]) }}">
                                            @csrf

                                            <button type="submit" class="w-fit bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors">Add</button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <form class="flex items-center gap-1.5" method="POST" action="{{ route('cart.add', ['product_id' => $product['product']['id'], 'attribute_id' => $product['attribute']['id'], 'quantity' => $product['qty'] - 1]) }}">
                                            @csrf

                                            <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Remove</button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <form method="POST" action="{{ route('cart.remove', ['product_id' => $product['product']['id'], 'attribute_id' => $product['attribute']['id']]) }}">
                                            @csrf

                                            <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Delete</button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $product['attribute']['price'] }}</td>
                                    <td class="py-3 px-6 text-left">{{ $product['attribute']['price'] * $product['qty'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h2 class="my-5 text-lg font-bold">You don't have any product in your cart.
                @endif
            </div>
            {{-- <?php if (isset($_SESSION["cart"])) { ?>
                <div>
                    <h2 class="text-2xl font-bold mb-5">Checkout</h2>
                    <div class="flex items-start justify-between gap-3 flex-wrap">
                        <form class="mb-6">
                            <h2 class="text-lg mb-5">Total Products: </h2>
                            <h2 class="text-lg mb-5">Total Price: </h2>
                            <h2 class="text-lg mb-5">Coupon: </h2>
                            <h2 class="text-lg mb-5">Net Price: </h2>
                            <div class="mb-4">
                                <label for="coupon_code">Coupon Code:</label>
                                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                                    placeholder="Enter coupon code" name="coupon_code" required />
                            </div>
                            <input type="hidden" name="cart_price" value="0" />
                            <input type="hidden" name="action" value="verify" />
                            <div class="flex items-center gap-3">
                                <button type="submit"
                                    class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Verify
                                    Coupon</button>
                            </div>
                        </form>
                        <form class="mb-6">
                            <div class="mb-4">
                                <label for="address">Address:</label>
                                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                                    placeholder="Enter your address" name="address" id="address" required />
                            </div>
                            <div class="mb-4">
                                <label for="city">City:</label>
                                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                                    placeholder="Enter your city" name="city" id="city" required />
                            </div>
                            <div class="mb-4">
                                <label for="pincode">Pincode:</label>
                                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                                    placeholder="Enter your pincode" name="pincode" id="pincode" required />
                            </div>
                            <input type="hidden" name="coupon_code" id="coupon_code" value="" />
                            <div class="flex items-center gap-3">
                                <button type="submit"
                                    class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Checkout</button>
                                <button class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Clear Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?> --}}
        </div>
    </div>
</x-app-layout>