<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $lateOnly = $request->boolean('late');

        $query = ReturnModel::with('loan.user', 'loan.book')->latest();

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if ($lateOnly) {
            $query->where('is_late', true);
        }

        $returns = $query->paginate(10)->withQueryString();

        $stats = [
            'pending' => ReturnModel::where('status', 'pending')->count(),
            'approved' => ReturnModel::where('status', 'approved')->count(),
            'late' => ReturnModel::where('is_late', true)->count(),
        ];

        return view('admin.returns.index', [
            'returns' => $returns,
            'stats' => $stats,
            'status' => $status,
            'lateOnly' => $lateOnly,
        ]);
    }

    public function approve(ReturnModel $return)
    {
        $loan = $return->loan;
        $now = Carbon::now();
        $isLate = $loan->due_at && $now->greaterThan($loan->due_at);

        $daysLate = 0;
        if ($isLate) {
            $daysLate = $loan->due_at->diffInDays($now);
        }

        $loan->update([
            'status' => 'returned',
            'returned_at' => $now,
            'is_late' => $isLate,
            'penalty_note' => $isLate ? 'Terlambat '.$daysLate.' hari' : null,
        ]);

        $return->update([
            'status' => 'approved',
            'approved_at' => $now,
            'is_late' => $isLate,
            'penalty_note' => $isLate ? 'Terlambat '.$daysLate.' hari' : null,
        ]);

        $loan->book->increment('stock');

        return back()->with('success', 'Pengembalian disetujui.');
    }

    public function reject(ReturnModel $return)
    {
        $return->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Permintaan pengembalian ditolak.');
    }
}
