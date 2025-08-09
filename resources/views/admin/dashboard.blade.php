<x-app-layout>
    <x-slot:title>Admin Dashboard</x-slot>

        @if (session('message'))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                        <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                    </div>
                </div>
            </div>
        @endif

        <div class='flex items-center justify-center h-screen'>
            <div class='gap-5 shadow-md rounded-md shadow-black text-center'>
                <h1 class='text-4xl font-bold capitalize mt-36'>Admin Statistics</h1>
                <p class='text-xl my-20'>This is a advanced laravel e-commerce website</p>
                <div class="flex items-center justify-center flex-wrap gap-5 mb-20">
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Users</span>
                        <span class='text-xl'>{{ $users }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Admins</span>
                        <span class='text-xl'>{{ $admins }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Categories</span>
                        <span class='text-xl'>{{ $categories }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Banners</span>
                        <span class='text-xl'>{{ $banners }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Products</span>
                        <span class='text-xl'>{{ $products }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Product Images</span>
                        <span class='text-xl'>{{ $product_images }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Product Attributes</span>
                        <span class='text-xl'>{{ $product_attributes }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Contacts</span>
                        <span class='text-xl'>{{ $contacts }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Coupons</span>
                        <span class='text-xl'>{{ $coupons }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Reviews</span>
                        <span class='text-xl'>{{ $reviews }}</span>
                    </div>
                    <div class='flex flex-col gap-3 bg-gray-200 rounded p-5'>
                        <span class='text-2xl font-bold'>Orders</span>
                        <span class='text-xl'>{{ $orders }}</span>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>