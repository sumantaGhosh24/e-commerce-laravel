<section>
    <h1 class="text-3xl font-semibold mb-4">Admin Add Product Image</h1>
    <form method="POST" action="{{ route('admin.product.image.add', ['id' => $product->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            <x-input-label for="image" :value="__('Profile Image')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300" :value="old('image')" required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <x-primary-button class="mt-4 max-w-fit">{{ __('Add Product Image') }}</x-primary-button>
    </form>
</section>