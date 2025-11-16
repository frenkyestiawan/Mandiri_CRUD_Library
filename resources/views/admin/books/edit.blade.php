<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.books.update', $book) }}" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input name="title" value="{{ old('title', $book->title) }}" class="mt-1 block w-full border-gray-300 rounded" />
                        @error('title')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Penulis</label>
                        <input name="author" value="{{ old('author', $book->author) }}" class="mt-1 block w-full border-gray-300 rounded" />
                        @error('author')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <input name="category" value="{{ old('category', $book->category) }}" class="mt-1 block w-full border-gray-300 rounded" />
                        @error('category')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" class="mt-1 block w-full border-gray-300 rounded" />
                            @error('stock')
                                <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                            <input name="published_year" value="{{ old('published_year', $book->published_year) }}" class="mt-1 block w-full border-gray-300 rounded" />
                            @error('published_year')
                                <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" class="mt-1 block w-full border-gray-300 rounded" rows="4">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cover Buku</label>
                        @if($book->cover)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $book->cover) }}" width="120" class="rounded shadow">
                            </div>
                        @endif
                        <input type="file" name="cover" class="mt-1 block w-full border-gray-300 rounded" />
                        @error('cover')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.books.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
