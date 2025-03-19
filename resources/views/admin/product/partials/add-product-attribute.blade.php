<section>
    <h1 class="text-3xl font-semibold mb-4">Admin Add Product Attribute</h1>
    <form method="POST" action="{{ route('admin.product.attribute.add', ['id' => $product->id]) }}">
        @csrf
        @method('put')

        <div class="mt-4">
            <x-input-label for="size" :value="__('Size')" />
            <x-text-input id="size" class="" type="text" name="size" :value="old('size')" required autofocus autocomplete="size" />
            <x-input-error :messages="$errors->get('size')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="color" :value="__('Color')" />
            <x-text-input id="color" class="" type="text" name="color" :value="old('color')" required autofocus autocomplete="color" />
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="mrp" :value="__('MRP')" />
            <x-text-input id="mrp" class="" type="text" name="mrp" :value="old('mrp')" required autofocus autocomplete="mrp" />
            <x-input-error :messages="$errors->get('mrp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="" type="text" name="price" :value="old('price')" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 max-w-fit">{{ __('Add Product Attribute') }}</x-primary-button>
    </form>
</section>