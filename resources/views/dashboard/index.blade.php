<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Add Client Form -->
            <div class="flex items-center space-x-2">
                <form method="POST" action="{{ route('clients.store') }}" class="flex flex-col sm:flex-row sm:items-center gap-4">
                    @csrf
                    <input
                        type="text"
                        name="name"
                        placeholder="Client name"
                        class="flex-1 px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300"
                    >

                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition"
                    >
                        Add Client
                    </button>
                </form>
            </div>

            <!-- Clients Table -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="text-lg font-bold mb-4">Registered Clients</h3>

                <table class="w-full text-left table-auto border-collapse">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Token</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Created At</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @forelse ($clients as $client)
                        <tr>
                            <td class="px-6 py-4">{{ $client->name }}</td>

                            <!-- Masked Token with Copy -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <input
                                        type="password"
                                        value="{{ $client->token }}"
                                        readonly
                                        class="w-64 px-3 py-1 border rounded bg-gray-100 font-mono text-sm"
                                        id="token-{{ $client->id }}"
                                    >
                                    <button
                                        onclick="navigator.clipboard.writeText(document.getElementById('token-{{ $client->id }}').value)"
                                        title="Copy to clipboard"
                                    >
                                        <i class="iconoir-copy"></i>
                                    </button>
                                </div>
                            </td>

                            <td class="px-6 py-4">{{ $client->created_at->format('Y-m-d H:i') }}</td>

                            <!-- Delete Button -->
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('clients.destroy', $client->id) }}"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-100 text-red-700 border border-red-400 hover:bg-red-200 font-semibold px-3 py-1 rounded transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No clients registered yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Copy Token Script -->
    <script>
        function copyToken(token) {
            navigator.clipboard.writeText(token).then(() => {
                alert('Token copied to clipboard');
            }).catch(err => {
                alert('Failed to copy token');
            });
        }
    </script>
</x-app-layout>
