<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman Buku') }}
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
                            <th class="px-3 py-2">Tgl Pinjam</th>
                            <th class="px-3 py-2">Jatuh Tempo</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $loan->user->name }}</td>
                                <td class="px-3 py-2">{{ $loan->book->title }}</td>
                                <td class="px-3 py-2">
                                    @php
                                        $status = $loan->status;
                                        $badgeClass = match($status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-blue-100 text-blue-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'returned' => 'bg-green-100 text-green-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                    @if($loan->is_late)
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Terlambat
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ optional($loan->borrowed_at)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2">{{ optional($loan->due_at)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <a href="{{ route('admin.loans.show', $loan) }}" class="text-blue-600">Detail</a>
                                    @if($loan->status === 'pending')
                                        <form action="{{ route('admin.loans.approve', $loan) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="text-green-600">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="text-red-600">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="6">Belum ada data peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
