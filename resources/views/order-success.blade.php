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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <div class="flex justify-center items-start h-screen p-5">
        <div
            class="rounded-lg shadow-md p-8 shadow-black w-[90%] flex flex-col gap-5">
            <h1 class="text-2xl font-bold">Complete Payment</h1>
            <button id="rzp-button" type="button" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Complete</button>
        </div>
    </div>

    <script>
        var options = {
            "key": "{{ $key }}",
            "amount": "{{ $amount }}",
            "currency": "INR",
            "name": "E-Commerce Website",
            "description": "Order products in your cart",
            "order_id": "{{ $order_id }}",
            "handler": function (response) {
                window.location.href = "{{ route('order.store') }}?razorpay_payment_id=" + response.razorpay_payment_id + "&coupon_code={{ $coupon_code }}&address={{ $address }}&city={{ $city }}&pincode={{ $pincode }}";
            },
            "prefill": {
                "name": "John Doe",
                "email": "johndoe@example.com",
                "contact": "9999999999"
            },
            "theme": {
                "color": "#528FF0"
            }
        };

        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</x-app-layout>