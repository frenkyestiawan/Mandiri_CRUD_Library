<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman Saya') }}
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
                            <th class="px-3 py-2">Buku</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Pinjam</th>
                            <th class="px-3 py-2">Jatuh Tempo</th>
                            <th class="px-3 py-2">Kembali</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $loan->book->title }}</td>
                                <td class="px-3 py-2">
                                    @php
                                        $status = $loan->status;
                                        $label = match($status) {
                                            'pending' => 'Menunggu persetujuan',
                                            'approved' => 'Sedang dipinjam',
                                            'returned' => 'Selesai',
                                            'rejected' => 'Ditolak',
                                            default => ucfirst($status),
                                        };
                                        $badgeClass = match($status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-blue-100 text-blue-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'returned' => 'bg-green-100 text-green-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                        {{ $label }}
                                    </span>
                                    @if($loan->is_late)
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Terlambat
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ optional($loan->borrowed_at)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2">{{ optional($loan->due_at)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2">{{ optional($loan->returned_at)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2">
                                    @if($loan->status === 'approved' && ! $loan->returnRequest)
                                        <form action="{{ route('member.loans.return-request', $loan) }}" method="POST">
                                            @csrf
                                            <button class="text-blue-600">Ajukan Pengembalian</button>
                                        </form>
                                    @elseif($loan->returnRequest && $loan->returnRequest->status === 'pending')
                                        <span class="text-gray-500">Menunggu persetujuan pengembalian</span>
                                    @elseif($loan->status === 'returned')
                                        <span class="text-green-600">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="6">Belum ada peminjaman.</td>
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
