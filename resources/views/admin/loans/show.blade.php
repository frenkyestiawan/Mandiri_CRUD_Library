<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <h3 class="font-semibold">Anggota</h3>
                    <p>{{ $loan->user->name }} ({{ $loan->user->email }})</p>
                </div>
                <div>
                    <h3 class="font-semibold">Buku</h3>
                    <p>{{ $loan->book->title }} oleh {{ $loan->book->author }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold">Status</h3>
                        <p>{{ ucfirst($loan->status) }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Tanggal</h3>
                        <p>Pinjam: {{ optional($loan->borrowed_at)->format('d/m/Y') ?? '-' }}</p>
                        <p>Jatuh Tempo: {{ optional($loan->due_at)->format('d/m/Y') ?? '-' }}</p>
                        <p>Kembali: {{ optional($loan->returned_at)->format('d/m/Y') ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold">Keterlambatan / Sanksi</h3>
                    <p>
                        @if($loan->is_late)
                            Terlambat
                            @if($loan->penalty_note)
                                - {{ $loan->penalty_note }}
                            @endif
                        @else
                            Tidak terlambat
                        @endif
                    </p>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <a href="{{ route('admin.loans.index') }}" class="px-4 py-2 bg-gray-200 rounded">Kembali</a>
                    @if($loan->status === 'pending')
                        <form action="{{ route('admin.loans.approve', $loan) }}" method="POST" class="inline">
                            @csrf
                            <button class="px-4 py-2 bg-green-600 text-white rounded">Approve</button>
                        </form>
                        <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" class="inline">
                            @csrf
                            <button class="px-4 py-2 bg-red-600 text-white rounded">Reject</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
