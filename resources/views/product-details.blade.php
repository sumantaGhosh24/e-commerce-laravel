<x-app-layout>
    <x-slot:title>{{ $product->meta_title }}</x-slot>

    <meta name='description' content='{{ $product->meta_description }}'>
    <meta name='keywords' content='{{ $product->meta_keywords }}'>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen">
        <div class="container mx-auto">
            <div class="shadow-md shadow-black p-5 rounded my-10">
                <h2 class="text-2xl font-bold capitalize">{{ $product->title }}</h2>
                <h3 class="text-lg font-medium my-5">{{ $product->description }}</h3>
                @if ($product->images->count() > 0)
                    <div class="flex items-center gap-3">
                        @foreach ($product->images as $img)
                            <img src="{{ asset('storage/' . $img->image) }}" alt="product" class="h-36 w-36 rounded" />
                        @endforeach
                    </div>
                @endif
                <h4 class="my-5">{{ $product->content }}</h4>
                <h4>Id: {{ $product->id }}</h4>
                <h4 class="font-extrabold my-5">MRP: {{ $product->mrp }}</h4>
                <h4 class="font-extrabold my-5">Price: {{ $product->price }}</h4>
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('storage/' . $product->category->image) }}" alt="category" class="h-16 w-16 rounded-full" />
                        <h4>{{ $product->category->name }}</h4>
                    </div>
                </div>
                <h5 class="my-5">Created At: {{ $product->created_at }}</h5>
                <h5>Updatd At:{{ $product->updated_at }}</h5>
            </div>
            <div class="shadow-md shadow-black p-5 rounded my-10">
                <div class="overflow-x-scroll">
                    <table class="min-w-full rounded-lg shadow-md mx-auto mt-5">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Size</th>
                                <th class="py-3 px-6 text-left">Color</th>
                                <th class="py-3 px-6 text-left">MRP</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product->attributes as $attribute)
                                <tr>
                                    <td class="py-3 px-6 text-left">{{ $attribute->id }}</td>
                                    <td class="py-3 px-6 text-left">{{ $attribute->size }}</td>
                                    <td class="py-3 px-6 text-left">{{ $attribute->color }}</td>
                                    <td class="py-3 px-6 text-left">{{ $attribute->mrp }}</td>
                                    <td class="py-3 px-6 text-left">{{ $attribute->price }}</td>
                                    <td class="py-3 px-6 text-left flex items-center gap-3">
                                        {{-- <form action="{{ route('admin.product.attribute.remove', ['id' => $attribute->id, 'attributeId' => $attribute->id]) }}" method="POST">
                                            @csrf
                                            @method('put')
        
                                            <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200">Delete</button>
                                        </form> --}}
                                        <button type="button" class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Add Cart</button>
                                    </td>
                                </tr>
                            @empty
                                <h2 class="text-2xl font-bold my-5">No Attributes Found!</h2>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>