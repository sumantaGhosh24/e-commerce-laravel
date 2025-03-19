<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Banner') }}</h2>
    </div>

    <form method="POST" action="{{ route('admin.banner.update', ['id' => $banner->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="heading1" :value="__('Heading 1')" />
            <x-text-input id="heading1" class="" type="text" name="heading1" :value="old('heading1', $banner->heading1)" required autofocus autocomplete="heading1" />
            <x-input-error :messages="$errors->get('heading1')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="heading2" :value="__('Heading 2')" />
            <x-text-input id="heading2" class="" type="text" name="heading2" :value="old('heading2', $banner->heading2)" required autofocus autocomplete="heading2" />
            <x-input-error :messages="$errors->get('heading2')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="btn_txt" :value="__('Button Text')" />
            <x-text-input id="btn_txt" class="" type="text" name="btn_txt" :value="old('btn_txt', $banner->btn_txt)" required autofocus autocomplete="btn_txt" />
            <x-input-error :messages="$errors->get('btn_txt')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="btn_link" :value="__('Button Link')" />
            <x-text-input id="btn_link" class="" type="text" name="btn_link" :value="old('btn_link', $banner->btn_link)" required autofocus autocomplete="btn_link" />
            <x-input-error :messages="$errors->get('btn_link')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" class="w-full" name="status" required>
                <option value="active">Active</option>
                <option value="deactive">Deactive</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 max-w-fit">{{ __('Update Banner') }}</x-primary-button>
    </form>
</section>