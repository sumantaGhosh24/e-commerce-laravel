<section>
    <h1 class="text-3xl font-semibold mb-4">Admin Remove Product Attribute</h1>
    <div>
        <div class="overflow-x-scroll">
            <table class="min-w-full rounded-lg shadow-md mx-auto mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Size</th>
                        <th class="py-3 px-6 text-left">Color</th>
                        <th class="py-3 px-6 text-left">MRP</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attributes as $attribute)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $attribute->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $attribute->size }}</td>
                            <td class="py-3 px-6 text-left">{{ $attribute->color }}</td>
                            <td class="py-3 px-6 text-left">{{ $attribute->mrp }}</td>
                            <td class="py-3 px-6 text-left">{{ $attribute->price }}</td>
                            <td class="py-3 px-6 text-left flex items-center gap-3">
                                <form action="{{ route('admin.product.attribute.remove', ['id' => $attribute->product_id, 'attributeId' => $attribute->id]) }}" method="POST">
                                    @csrf
                                    @method('put')

                                    <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Attributes Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>