<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Category Image') }}</h2>
    </div>

    <form method="post" action="{{ route('admin.category.image', ['id' => $category->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="Profile Image" class="w-full h-auto rounded-md" />
            @endif
        </div>

        <div>
            <x-input-label for="image" :value="__('Profile Image')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300" :value="old('image', $category->image)" required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
</section>