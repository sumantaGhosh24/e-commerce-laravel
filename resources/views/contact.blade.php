<x-app-layout>
    <x-slot:title>Contact Us</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[60%]">
            <h1 class="text-3xl font-semibold mb-4">Contact Us</h1>
            <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <x-input-label for="message" :value="__('Message')" />
                    <textarea id="message" name="message" rows="5" cols="50" class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="message">{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4 max-w-fit">{{ __('Send Message') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>