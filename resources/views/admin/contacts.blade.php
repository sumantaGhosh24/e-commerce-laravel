<x-app-layout>
    <x-slot:title>Admin Manage Contact Us</x-slot>

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
        <h2 class="text-2xl font-bold mb-4 text-center">Manage Contact Us</h2>
        <div class="container mx-auto overflow-x-scroll">
            <table class="bg-white rounded-lg shadow-md mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Message</th>
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $contact->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->message }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->user->email }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->updated_at }}</td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Contact Us Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $contacts->links() }}
    </div>
</x-app-layout>