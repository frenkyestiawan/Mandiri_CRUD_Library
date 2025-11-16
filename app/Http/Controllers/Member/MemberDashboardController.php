<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $recommendedBooks = Book::withCount('loans')
            ->orderByDesc('loans_count')
            ->limit(5)
            ->get();

        $myLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        $activeLoansCount = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        $lateReturnsCount = Loan::where('user_id', $user->id)
            ->where('is_late', true)
            ->count();

        $pendingApprovedLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->latest()
            ->limit(10)
            ->get();

        return view('member.dashboard', compact(
            'recommendedBooks',
            'myLoans',
            'activeLoansCount',
            'lateReturnsCount',
            'pendingApprovedLoans'
        ));
    }
}
