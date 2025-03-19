<section>
    <h1 class="text-3xl font-semibold mb-4">Admin Update Product</h1>
    <form method="POST" action="{{ route('admin.product.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="" type="text" name="title" :value="old('title', $product->title)" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id='description' name='description' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Enter product description" required autofocus autocomplete="description">{{ old('description', $product->description) }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <textarea id='content' name='content' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Enter product content" required autofocus autocomplete="content">{{ old('content', $product->content) }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="mrp" :value="__('MRP')" />
            <x-text-input id="mrp" class="" type="text" name="mrp" :value="old('mrp', $product->mrp)" required autofocus autocomplete="mrp" />
            <x-input-error :messages="$errors->get('mrp', $product->mrp)" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="" type="text" name="price" :value="old('price', $product->price)" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price', $product->price)" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="meta_title" :value="__('Meta Title')" />
            <x-text-input id="meta_title" class="" type="text" name="meta_title" :value="old('meta_title', $product->meta_title)" required autofocus autocomplete="meta_title" />
            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="meta_desc" :value="__('Meta Description')" />
            <x-text-input id="meta_desc" class="" type="text" name="meta_desc" :value="old('meta_desc', $product->meta_desc)" required autofocus autocomplete="meta_desc" />
            <x-input-error :messages="$errors->get('meta_desc', $product->meta_desc)" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="meta_keyword" :value="__('Meta Keyword')" />
            <x-text-input id="meta_keyword" class="" type="text" name="meta_keyword" :value="old('meta_keyword', $product->meta_keyword)" required autofocus autocomplete="meta_keyword" />
            <x-input-error :messages="$errors->get('meta_keyword', $product->meta_keyword)" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id" :value="__('Category')" />
            <select id='category_id' name='category_id' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Select category" value="{{ old('category_id', $product->category_id) }}" required autofocus autocomplete="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select id='status' name='status' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Select category" value="{{ old('status', $product->status) }}" required autofocus autocomplete="status">
                <option value="active">Active</option>
                <option value="deactive">Deactive</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 max-w-fit">{{ __('Update Product') }}</x-primary-button>
    </form>
</section>