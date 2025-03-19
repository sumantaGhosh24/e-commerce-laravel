<x-app-layout>
    <x-slot:title>Admin Manage Banners</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-700">
                    <h2 class="p-6 text-white font-bold">{{ session('message') }}</h2>
                </div>
            </div>
        </div>
    @endif

    <div class="pt-8">
        <div class="flex items-center justify-between container mx-auto">
            <h2 class="text-2xl font-bold mb-4 text-center">Manage Banners</h2>
            <a href="{{ route('admin.banner.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200 w-fit">Create Banner</a>
        </div>
        <div class="overflow-x-scroll">
            <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Heading 1</th>
                        <th class="py-3 px-6 text-left">Heading 2</th>
                        <th class="py-3 px-6 text-left">Button Text</th>
                        <th class="py-3 px-6 text-left">Button Link</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $banner->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $banner->heading1 }}</td>
                            <td class="py-3 px-6 text-left">{{ $banner->heading2 }}</td>
                            <td class="py-3 px-6 text-left">{{ $banner->btn_txt }}</td>
                            <td class="py-3 px-6 text-left">{{ $banner->btn_link }}</td>
                            <td class="py-3 px-6 text-left">
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="banner" class="w-12 h-12 rounded-full" />
                            </td>
                            <td class="py-3 px-6 text-left">
                                @if($banner->status === 'active')
                                    <span class="bg-green-500 text-white px-2 py-1.5 rounded">Active</span>
                                @else
                                    <span class="bg-red-500 text-white px-2 py-1.5 rounded">Deactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">{{ $banner->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $banner->updated_at }}</td>
                            <td class="py-3 px-6 text-left flex items-center gap-3">
                                <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}" class="w-fit bg-green-500 px-4 py-2 rounded-md hover:bg-green-600 transition-colors disabled:bg-green-200 text-white">Update</a>
                                <form method="POST" action="{{ route('admin.banner.destroy', ['id' => $banner->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="w-fit bg-red-500 px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200 text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Banners Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>