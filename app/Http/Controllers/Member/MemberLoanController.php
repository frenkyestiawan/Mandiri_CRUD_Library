<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\ReturnModel;
use Illuminate\Http\Request;

class MemberLoanController extends Controller
{
    public function listBooks(Request $request)
    {
        $category = $request->input('category');
        $sort = $request->input('sort');
        $search = $request->input('search');

        $query = Book::query();

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($search)) {
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

        return view('member.books.index', compact('books', 'categories', 'category', 'sort', 'search'));
    }

    public function show(Book $book)
    {
        return view('member.books.show', compact('book'));
    }

    public function index()
    {
        $loans = Loan::with('book', 'returnRequest')
            ->where('user_id', auth()->id())
            ->latest()->paginate(10);

        return view('member.loans.index', compact('loans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $user = auth()->user();

        $activeLoansCount = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($activeLoansCount >= 3) {
            return back()->with('error', 'Batas peminjaman aktif tercapai (maksimal 3 buku).')
                ->withInput();
        }

        $book = Book::findOrFail($data['book_id']);

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia saat ini.')
                ->withInput();
        }

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan peminjaman dikirim dan menunggu persetujuan petugas.');
    }

    public function requestReturn(Loan $loan)
    {
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        if ($loan->status !== 'approved') {
            return back()->with('error', 'Hanya peminjaman yang sedang berjalan yang dapat diajukan pengembalian.');
        }

        ReturnModel::firstOrCreate(
            ['loan_id' => $loan->id],
            [
                'status' => 'pending',
                'requested_at' => now(),
            ]
        );

        return back()->with('success', 'Permintaan pengembalian dikirim.');
    }
}
