<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');
        $sort = $request->input('sort');
        $search = $request->input('search');

        $query = Book::query();

        if (! empty($category)) {
            $query->where('category', $category);
        }

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('author', 'like', '%'.$search.'%');
            });
        }

        switch ($sort) {
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'za':
                $query->orderBy('title', 'desc');
                break;
            case 'popular':
                $query->withCount('loans')
                    ->orderBy('loans_count', 'desc');
                break;
            case 'newest':
                $query->orderBy('published_year', 'desc');
                break;
            case 'stock':
                $query->orderBy('stock', 'desc');
                break;
            default:
                $query->orderBy('title', 'asc');
                break;
        }

        $books = $query->paginate(10)->withQueryString();

        $categories = [
            'Fiksi',
            'Non-Fiksi',
            'Pendidikan / Akademik',
            'Teknologi & Komputer',
            'Bisnis & Ekonomi',
            'Seni & Desain',
            'Kesehatan & Kedokteran',
            'Agama',
            'Anak & Remaja',
            'Sejarah & Budaya',
        ];

        return view('admin.books.index', compact('books', 'categories', 'category', 'sort', 'search'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'published_year' => 'nullable|digits:4',
            'description' => 'nullable|string',
        ]);
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'published_year' => 'nullable|digits:4',
            'description' => 'nullable|string',
        ]);
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }

            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Data buku berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
