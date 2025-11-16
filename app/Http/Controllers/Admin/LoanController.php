<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->latest()->paginate(10);
        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load(['user', 'book', 'returnRequest']);
        return view('admin.loans.show', compact('loan'));
    }

    public function approve(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Status peminjaman bukan pending.');
        }

        $loan->update([
            'status' => 'approved',
            'borrowed_at' => now(),
            'due_at' => now()->addDays(7),
        ]);

        $loan->book->decrement('stock');

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Status peminjaman bukan pending.');
        }

        $loan->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Peminjaman ditolak.');
    }
}
