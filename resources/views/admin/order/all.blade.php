<x-app-layout>
    <x-slot:title>Admin Manage Orders</x-slot>

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
        <h2 class="text-2xl font-bold mb-4 text-center">Manage Orders</h2>
        <div class="container mx-auto overflow-x-scroll">
            <table class="bg-white rounded-lg shadow-md mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Total Price</th>
                        <th class="py-3 px-6 text-left">Net Price</th>
                        <th class="py-3 px-6 text-left">Order Status</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $order->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->total_price }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->net_price }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->order_status }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->address }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->updated_at }}</td>
                            <td class="py-3 px-6 text-left flex items-center gap-3">
                                <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="w-fit bg-green-500 px-4 py-2 rounded-md hover:bg-green-600 transition-colors disabled:bg-green-200 text-white">Update</a>
                            </td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Orders Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>