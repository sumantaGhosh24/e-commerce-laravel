<x-app-layout>
    <x-slot:title>User Dashboard</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        .swiper-wrapper {
            width: 100%;
            height: max-content !important;
            padding-bottom: 64px !important;
            -webkit-transition-timing-function: linear !important;
            transition-timing-function: linear !important;
            position: relative;
        }

        .swiper-pagination-bullet {
            background: #4f46e5;
        }
    </style>

    {{-- FIXME: carousel not working --}}
    <div class="w-full relative">
        <div class="swiper default-carousel swiper-container">
            <div class="swiper-wrapper" id="slides"></div>
            <div class="flex items-center gap-8 lg:justify-start justify-center">
                <button id="slider-button-left"
                    class="swiper-button-prev group !p-2 flex justify-center items-center border border-solid border-blue-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8 !left-5 hover:bg-blue-600 "
                    data-carousel-prev>
                    <svg class="h-5 w-5 text-blue-600 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M10.0002 11.9999L6 7.99971L10.0025 3.99719" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button id="slider-button-right"
                    class="swiper-button-next group !p-2 flex justify-center items-center border border-solid border-blue-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8  !right-5 hover:bg-blue-600"
                    data-carousel-next>
                    <svg class="h-5 w-5 text-blue-600 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M5.99984 4.00012L10 8.00029L5.99748 12.0028" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="swiper-pagination">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="h-96 flex flex-col justify-center items-center gap-5" style="background: url('{{ asset('storage/' . $banner->image) }}') center center/cover no-repeat;">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="banner" class="h-48 w-full rounded-md" />
                            <span class="text-3xl font-semibold text-blue-600">{{ $banner->heading1 }}</span>
                            <span class="text-xl text-blue-400">{{ $banner->heading2 }}</span>
                            <a href="{{ $banner->btn_link }}" class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors uppercase">{{ $banner->btn_txt }}</a>
                        </div>
                    </div>                        
                @endforeach
            </div>
        </div>
    </div>

    <div class='flex items-center justify-center h-screen'>
        <div class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black text-center'>
            <h1 class='text-4xl font-bold capitalize mt-36'>Welcome to laravle e-commerce website</h1>
            <p class='text-xl my-20'>This is a advanced laravel e-commerce website</p>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".default-carousel", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</x-app-layout>