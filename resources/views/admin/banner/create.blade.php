<x-app-layout>
    <x-slot:title>Admin Create Banner</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[60%]">
            <h1 class="text-3xl font-semibold mb-4">Admin Create Banner</h1>
            <form method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <x-input-label for="heading1" :value="__('Heading 1')" />
                    <x-text-input id="heading1" class="" type="text" name="heading1" :value="old('heading1')" required autofocus autocomplete="heading1" />
                    <x-input-error :messages="$errors->get('heading1')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="heading2" :value="__('Heading 2')" />
                    <x-text-input id="heading2" class="" type="text" name="heading2" :value="old('heading2')" required autofocus autocomplete="heading2" />
                    <x-input-error :messages="$errors->get('heading2')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="btn_txt" :value="__('Button Text')" />
                    <x-text-input id="btn_txt" class="" type="text" name="btn_txt" :value="old('btn_txt')" required autofocus autocomplete="btn_txt" />
                    <x-input-error :messages="$errors->get('btn_txt')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="btn_link" :value="__('Button Link')" />
                    <x-text-input id="btn_link" class="" type="text" name="btn_link" :value="old('btn_link')" required autofocus autocomplete="btn_link" />
                    <x-input-error :messages="$errors->get('btn_link')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" name="image" type="file" class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300" :value="old('image')" required autofocus autocomplete="image" />
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>

                <x-primary-button class="mt-4 max-w-fit">{{ __('Create Banner') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>