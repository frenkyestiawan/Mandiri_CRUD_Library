<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $totalBooks = Book::count();
        $totalLoansThisMonth = Loan::whereMonth('borrowed_at', $now->month)
            ->whereYear('borrowed_at', $now->year)
            ->count();
        $totalPendingLoans = Loan::where('status', 'pending')->count();
        $totalLateReturns = Loan::where('is_late', true)->count();

        $topBooks = Book::withCount('loans')
            ->orderByDesc('loans_count')
            ->limit(5)
            ->get();

        $loanStatusCounts = Loan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthlyLoansRaw = Loan::selectRaw('MONTH(borrowed_at) as month, COUNT(*) as total')
            ->whereYear('borrowed_at', $now->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyLoans = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyLoans[$m] = $monthlyLoansRaw[$m] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalLoansThisMonth',
            'totalPendingLoans',
            'totalLateReturns',
            'topBooks',
            'loanStatusCounts',
            'monthlyLoans'
        ));
    }
}
