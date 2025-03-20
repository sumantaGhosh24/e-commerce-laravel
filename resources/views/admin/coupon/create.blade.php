<x-app-layout>
    <x-slot:title>Admin Create Coupon</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[60%]">
            <h1 class="text-3xl font-semibold mb-4">Admin Create Coupon</h1>
            <form method="POST" action="{{ route('admin.coupon.store') }}">
                @csrf

                <div>
                    <x-input-label for="coupon_code" :value="__('Coupon Code')" />
                    <x-text-input id="coupon_code" class="" type="text" name="coupon_code" :value="old('coupon_code')" required autofocus autocomplete="coupon_code" />
                    <x-input-error :messages="$errors->get('coupon_code')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="coupon_value" :value="__('Coupon Value')" />
                    <x-text-input id="coupon_value" class="" type="text" name="coupon_value" :value="old('coupon_value')" required autofocus autocomplete="coupon_value" />
                    <x-input-error :messages="$errors->get('coupon_value')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="coupon_type" :value="__('Coupon Type')" />
                    <select id="coupon_type" name="coupon_type" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                        <option value="percent">Percentage</option>
                        <option value="Rupee">Rupee</option>
                    </select>
                    <x-input-error :messages="$errors->get('coupon_type')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="cart_min_value" :value="__('Cart Min Value')" />
                    <x-text-input id="cart_min_value" class="" type="text" name="cart_min_value" :value="old('cart_min_value')" required autofocus autocomplete="cart_min_value" />
                    <x-input-error :messages="$errors->get('cart_min_value')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4 max-w-fit">{{ __('Create Coupon') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>