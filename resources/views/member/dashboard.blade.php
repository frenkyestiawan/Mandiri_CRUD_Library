<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Anggota') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="p-4 bg-blue-100 rounded">
                        <div class="text-sm text-gray-500">Peminjaman Aktif</div>
                        <div class="text-2xl font-bold">{{ $activeLoansCount }}</div>
                    </div>
                    <div class="p-4 bg-red-100 rounded">
                        <div class="text-sm text-gray-500">Pengembalian Terlambat</div>
                        <div class="text-2xl font-bold">{{ $lateReturnsCount }}</div>
                    </div>
                </div>
                <h3 class="font-semibold mb-2">Rekomendasi Buku</h3>
                <ul class="list-disc list-inside text-sm">
                    @forelse($recommendedBooks as $book)
                        <li>{{ $book->title }} oleh {{ $book->author }} ({{ $book->loans_count }} kali dipinjam)</li>
                    @empty
                        <li>Belum ada data buku.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Riwayat Peminjaman Saya</h3>
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-3 py-2">Buku</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Pinjam</th>
                            <th class="px-3 py-2">Jatuh Tempo</th>
                            <th class="px-3 py-2">Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myLoans as $loan)
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
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="5">Belum ada riwayat peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Peminjaman Pending / Sedang Diproses</h3>
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-3 py-2">Buku</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Pinjam</th>
                            <th class="px-3 py-2">Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingApprovedLoans as $loan)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $loan->book->title }}</td>
                                <td class="px-3 py-2">
                                    @php
                                        $status = $loan->status;
                                        $label = match($status) {
                                            'pending' => 'Menunggu persetujuan',
                                            'approved' => 'Sedang dipinjam',
                                            default => ucfirst($status),
                                        };
                                        $badgeClass = match($status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">{{ optional($loan->borrowed_at)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2">{{ optional($loan->due_at)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="4">Tidak ada peminjaman pending atau sedang diproses.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
