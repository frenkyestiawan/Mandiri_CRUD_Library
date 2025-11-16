<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
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

                <form method="GET" action="{{ route('member.books.index') }}" class="mb-4 flex flex-wrap items-center gap-3 text-sm">
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Kategori</label>
                        <select name="category" class="border rounded px-2 py-1">
                            <option value="">Semua</option>
                            @isset($categories)
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ (isset($category) && $category === $cat) ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Urutkan</label>
                        <select name="sort" class="border rounded px-2 py-1">
                            <option value="">Judul A  Z (default)</option>
                            <option value="az" {{ (isset($sort) && $sort === 'az') ? 'selected' : '' }}>Judul A  Z</option>
                            <option value="za" {{ (isset($sort) && $sort === 'za') ? 'selected' : '' }}>Judul Z  A</option>
                            <option value="popular" {{ (isset($sort) && $sort === 'popular') ? 'selected' : '' }}>Populer</option>
                            <option value="newest" {{ (isset($sort) && $sort === 'newest') ? 'selected' : '' }}>Terbaru</option>
                            <option value="stock" {{ (isset($sort) && $sort === 'stock') ? 'selected' : '' }}>Stok terbanyak</option>
                        </select>
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs text-gray-600 mb-1">Cari</label>
                        <input type="text" name="search" placeholder="Judul atau penulis" value="{{ $search ?? '' }}" class="border rounded px-2 py-1 w-full">
                    </div>

                    <div class="pt-5 flex items-center gap-2">
                        <button type="submit" class="px-4 py-1 bg-blue-600 text-white rounded">Terapkan</button>
                        <a href="{{ route('member.books.index') }}" class="px-4 py-1 bg-gray-200 text-gray-800 rounded">Tampilkan semua</a>
                    </div>
                </form>

                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-3 py-2">Judul</th>
                            <th class="px-3 py-2">Penulis</th>
                            <th class="px-3 py-2">Kategori</th>
                            <th class="px-3 py-2">Stok</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            @php
                                $status = $book->stock > 0 ? 'Available' : 'Sedang dipinjam';
                            @endphp
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $book->title }}</td>
                                <td class="px-3 py-2">{{ $book->author }}</td>
                                <td class="px-3 py-2">{{ $book->category }}</td>
                                <td class="px-3 py-2">{{ $book->stock }}</td>
                                <td class="px-3 py-2">{{ $status }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <a href="{{ route('member.books.show', $book) }}" class="text-indigo-600">Detail</a>
                                    @if($book->stock > 0)
                                        <form action="{{ route('member.loans.store') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button class="text-blue-600">Pinjam</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">Tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="6">Belum ada data buku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
