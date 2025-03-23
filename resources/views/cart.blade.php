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
            @if ($cart)
                <div class="w-full">
                    <h2 class="text-2xl font-bold mb-5">Checkout</h2>
                    <div class="flex items-start justify-between gap-3">
                        <form class="mb-6 w-full" method="POST" action="{{ route('cart.coupon') }}">
                            @csrf

                            <h2 class="text-lg mb-5">Total Products: {{ $totalProducts }}</h2>
                            <h2 class="text-lg mb-5">Total Price: {{ $totalCartValue }}</h2>
                            <h2 class="text-lg mb-5">Coupon: {{ session('coupon_code') }}</h2>
                            <h2 class="text-lg mb-5">Net Price: {{ session('net_price', $totalCartValue) }}</h2>
                            <div class="mb-4">
                                <x-input-label for="coupon_code" :value="__('Coupon Code')" />
                                <x-text-input id="coupon_code" class="" type="text" name="coupon_code" :value="old('coupon_code')" required autofocus autocomplete="coupon_code" />
                                <x-input-error :messages="$errors->get('coupon_code')" class="mt-2" />
                            </div>
                            <x-primary-button class="mt-4 max-w-fit">{{ __('Verify Coupon') }}</x-primary-button>
                        </form>
                        <form class="mb-6 w-full" method="POST" action={{ route('order.create', ['coupon_code' => session('coupon_code')]) }}>
                            @csrf

                            <div class="mb-4">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" class="" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" class="" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="pincode" :value="__('Pincode')" />
                                <x-text-input id="pincode" class="" type="text" name="pincode" :value="old('pincode')" required autofocus autocomplete="pincode" />
                                <x-input-error :messages="$errors->get('pincode')" class="mt-2" />
                            </div>
                            <x-primary-button class="mt-4 max-w-fit">{{ __('Checkout') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>