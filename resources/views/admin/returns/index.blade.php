<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permintaan Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 text-sm text-green-600">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 text-sm text-red-600">{{ session('error') }}</div>
                @endif

                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-3 py-2">Anggota</th>
                            <th class="px-3 py-2">Buku</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Diminta Pada</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returns as $return)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $return->loan->user->name }}</td>
                                <td class="px-3 py-2">{{ $return->loan->book->title }}</td>
                                <td class="px-3 py-2">
                                    @php
                                        $status = $return->status;
                                        $badgeClass = match($status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                    @if($return->is_late)
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Terlambat
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ optional($return->requested_at)->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    @if($return->status === 'pending')
                                        <form action="{{ route('admin.returns.approve', $return) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="text-green-600">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.returns.reject', $return) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="text-red-600">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="5">Belum ada permintaan pengembalian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $returns->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
