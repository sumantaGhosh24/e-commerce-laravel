<x-app-layout>
    <x-slot:title>Admin Create Category</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[60%]">
            <h1 class="text-3xl font-semibold mb-4">Admin Create Category</h1>
            <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" name="image" type="file" class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300" :value="old('image')" required autofocus autocomplete="image" />
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>

                <x-primary-button class="mt-4 max-w-fit">{{ __('Create Category') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>