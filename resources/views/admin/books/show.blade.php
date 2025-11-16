<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row gap-6">
                <div>
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" class="w-48 md:w-64 rounded shadow" alt="Cover {{ $book->title }}">
                    @else
                        <div class="w-48 md:w-64 h-64 bg-gray-100 flex items-center justify-center rounded">
                            <span class="text-gray-400 text-sm">Tidak ada cover</span>
                        </div>
                    @endif
                </div>

                <div class="flex-1 space-y-3">
                    <h1 class="text-2xl font-bold">{{ $book->title }}</h1>
                    <div class="text-sm text-gray-600">Oleh {{ $book->author }}</div>
                    <div class="text-sm text-gray-600">Kategori: {{ $book->category ?? '-' }}</div>
                    <div class="text-sm text-gray-600">Tahun Terbit: {{ $book->published_year ?? '-' }}</div>
                    <div class="text-sm text-gray-600">Stok: {{ $book->stock }}</div>

                    <div class="mt-4">
                        <h3 class="font-semibold mb-1">Sinopsis</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $book->description ?? 'Belum ada sinopsis.' }}</p>
                    </div>

                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('admin.books.edit', $book) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Edit</a>
                        <a href="{{ route('admin.books.index') }}" class="px-4 py-2 bg-gray-200 rounded">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
