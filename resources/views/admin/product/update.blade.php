<x-app-layout>
    <x-slot:title>Admin Update Product</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow-md rounded-md shadow-black">
                <div class="max-w-xl">
                    @include('admin.product.partials.update-product-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md shadow-black">
                <div class="max-w-xl">
                    @include('admin.product.partials.add-product-image')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md shadow-black">
                <div class="max-w-xl">
                    @include('admin.product.partials.remove-product-image')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md shadow-black">
                <div class="max-w-xl">
                    @include('admin.product.partials.add-product-attribute')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md shadow-black">
                <div class="max-w-xl">
                    @include('admin.product.partials.remove-product-attribute')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>