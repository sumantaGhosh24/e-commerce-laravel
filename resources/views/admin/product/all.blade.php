<x-app-layout>
    <x-slot:title>Admin Manage Products</x-slot>

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
            <h2 class="text-2xl font-bold mb-4 text-center">Manage Products</h2>
            <a href="{{ route('admin.product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200 w-fit">Create Product</a>
        </div>
        <div class="overflow-x-scroll">
            <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Content</th>
                        <th class="py-3 px-6 text-left">MRP</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Meta Title</th>
                        <th class="py-3 px-6 text-left">Meta Description</th>
                        <th class="py-3 px-6 text-left">Meta Keyword</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Images</th>
                        <th class="py-3 px-6 text-left">Attributes</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $product->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->title }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->description }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->content }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->mrp }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->price }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->meta_title }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->meta_desc }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->meta_keyword }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($product->status === 'active')
                                    <span class="bg-green-500 text-white px-2 py-1.5 rounded">Active</span>
                                @else
                                    <span class="bg-red-500 text-white px-2 py-1.5 rounded">Deactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">{{ $product->category->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->images->count() }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->attributes->count() }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $product->updated_at }}</td>
                            <td class="py-3 px-6 text-left flex items-center gap-3">
                                <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="w-fit bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors disabled:bg-green-200">Update</a>
                                <form action="{{ route('admin.product.destroy', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Products Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>