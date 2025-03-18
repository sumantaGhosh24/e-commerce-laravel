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
        <div class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black text-center'>
            <h1 class='text-4xl font-bold capitalize mt-36'>Welcome to laravle e-commerce website</h1>
            <p class='text-xl my-20'>This is a advanced laravel e-commerce website</p>
        </div>
    </div>
</x-app-layout>