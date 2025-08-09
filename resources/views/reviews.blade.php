<x-app-layout>
    <x-slot:title>My Reviews</x-slot>

    <div class="pt-8">
        <h2 class="text-2xl font-bold mb-4 text-center">My Reviews</h2>
        <div class="container mx-auto overflow-x-scroll">
            <table class="bg-white rounded-lg shadow-md mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Rating</th>
                        <th class="py-3 px-6 text-left">Message</th>
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $review->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $review->rating }}</td>
                            <td class="py-3 px-6 text-left">{{ $review->review }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="{{ route('product.details', ['id' => $review->product->id]) }}" class="underline bg-green-700 text-white px-1.5 py-1 rounded">
                                    {{ $review->product->title }}
                                </a>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $review->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $review->updated_at }}</td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Reviews Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>