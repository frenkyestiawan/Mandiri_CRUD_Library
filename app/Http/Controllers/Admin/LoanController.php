<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $lateOnly = $request->boolean('late');

        $query = Loan::with(['user', 'book'])->latest();

        if (! empty($status)) {
            $query->where('status', $status);
        }

        if ($lateOnly) {
            $query->where('is_late', true);
        }

        $loans = $query->paginate(10)->withQueryString();

        $stats = [
            'pending' => Loan::where('status', 'pending')->count(),
            'approved' => Loan::where('status', 'approved')->count(),
            'late' => Loan::where('is_late', true)->count(),
            'returned' => Loan::where('status', 'returned')->count(),
        ];

        return view('admin.loans.index', [
            'loans' => $loans,
            'stats' => $stats,
            'status' => $status,
            'lateOnly' => $lateOnly,
        ]);
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
