<x-app-layout>
    <x-slot:title>Welcome</x-slot>

    <div class='flex items-center justify-center h-screen'>
        <div class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black text-center'>
            <h1 class='text-4xl font-bold capitalize mt-36'>Welcome to laravle e-commerce website</h1>
            <p class='text-xl my-20'>This is a advanced laravel e-commerce website</p>
            <a href="{{ route('login') }}" class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded'>Login</a>
            <a href="{{ route('register') }}" class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded'>Register</a>
        </div>
    </div>
</x-app-layout>