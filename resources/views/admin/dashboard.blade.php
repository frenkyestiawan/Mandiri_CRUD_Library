<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="p-4 bg-blue-100 rounded">
                        <div class="text-sm text-gray-500">Total Buku</div>
                        <div class="text-2xl font-bold">{{ $totalBooks }}</div>
                    </div>
                    <div class="p-4 bg-green-100 rounded">
                        <div class="text-sm text-gray-500">Peminjaman Bulan Ini</div>
                        <div class="text-2xl font-bold">{{ $totalLoansThisMonth }}</div>
                    </div>
                    <div class="p-4 bg-yellow-100 rounded">
                        <div class="text-sm text-gray-500">Peminjaman Pending</div>
                        <div class="text-2xl font-bold">{{ $totalPendingLoans }}</div>
                    </div>
                    <div class="p-4 bg-red-100 rounded">
                        <div class="text-sm text-gray-500">Pengembalian Terlambat</div>
                        <div class="text-2xl font-bold">{{ $totalLateReturns }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold mb-2">Ringkasan Status Peminjaman</h3>
                    @php
                        $statuses = ['pending', 'approved', 'rejected', 'returned'];
                    @endphp
                    <table class="min-w-full text-left text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statuses as $status)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ ucfirst($status) }}</td>
                                    <td class="px-3 py-2">{{ $loanStatusCounts[$status] ?? 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold mb-2">Buku Paling Sering Dipinjam</h3>
                    <table class="min-w-full text-left text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="px-3 py-2">Buku</th>
                                <th class="px-3 py-2">Dipinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topBooks as $book)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $book->title }}</td>
                                    <td class="px-3 py-2">{{ $book->loans_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-3 py-4" colspan="2">Belum ada data peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Peminjaman per Bulan ({{ now()->year }})</h3>
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-3 py-2">Bulan</th>
                            <th class="px-3 py-2">Jumlah Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyLoans as $month => $total)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</td>
                                <td class="px-3 py-2">{{ $total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
