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
    <div class="flex items-center justify-between gap-3">
        @foreach ($banners as $banner)
            <div class="swiper-slide">
                <div class="flex flex-col items-start p-5 rounded gap-5 h-[250px] w-full" style="background: url('{{ asset('storage/' . $banner->image) }}') center center/cover no-repeat;">
                    <span class="text-3xl font-semibold text-blue-600">{{ $banner->heading1 }}</span>
                    <span class="text-xl text-blue-400">{{ $banner->heading2 }}</span>
                    <a href="{{ $banner->btn_link }}" class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors uppercase" target="blank">{{ $banner->btn_txt }}</a>
                </div>
            </div>                        
        @endforeach
    </div>

    <div class="flex justify-center items-center">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[90%] my-20">
            <form action="{{ route('dashboard') }}">
                <div class="flex items-center justify-between gap-2 flex-col md:flex-row">
                    <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Search product" name="title" id="title" value="" />
                    <select name="category_id" id="category_id" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Search product" name="min_price" id="min_price" value="0" />
                    <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Search product" name="max_price" id="max_price" value="1000" />
                    <select name="sort_by" id="sort_by" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"">
                        <option value="created_at">Created At</option>
                        <option value="price">Price</option>
                    </select>
                    <select name="sort_order" id="sort_order" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Search Product</button>
                </div>
            </form>
            <div class="flex flex-col gap-3 my-5">
                @foreach ($products as $product)
                    <a href="{{ route('product.details', ['id' => $product->id])}}" class='my-5'>
                        <div class="shadow-black shadow-md rounded p-5">
                            <h2 class="capitalize text-2xl font-bold">{{ $product->title }}</h2>
                            <p class="my-3">{{ $product->description }}</p>
                            <p><strong>MRP:</strong> ${{ $product->mrp }}</p>
                            <p><strong>Price:</strong> ${{ $product->price }}</p>
                            <p class="mt-3"><strong>Category:</strong> {{ $product->category->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>