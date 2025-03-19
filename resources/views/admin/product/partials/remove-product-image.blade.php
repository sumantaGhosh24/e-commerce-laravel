<section>
    <h1 class="text-3xl font-semibold mb-4">Admin Remove Product Image</h1>
    <div>
        <div class="mb-5 flex items-center gap-3">
            @foreach ($images as $image)
                <form class="mt-6 p-4 relative removeImage_form" method="POST" action="{{ route('admin.product.image.remove', ['id' => $product->id, 'imageId' => $image->id]) }}">
                    @csrf
                    @method('put')

                    <img src="{{ asset('storage/' . $image->image) }}" alt="product" class="h-36 w-36 rounded" />
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors absolute top-5 right-5"><i class="fa-solid fa-trash"></i></button>
                </form>
            @endforeach
        </div>
    </div>
</section>