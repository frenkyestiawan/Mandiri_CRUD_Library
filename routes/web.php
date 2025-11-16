<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\Admin\ReturnController as AdminReturnController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\MemberLoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('member.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('books', AdminBookController::class);

        Route::get('loans', [AdminLoanController::class, 'index'])->name('loans.index');
        Route::get('loans/{loan}', [AdminLoanController::class, 'show'])->name('loans.show');
        Route::post('loans/{loan}/approve', [AdminLoanController::class, 'approve'])->name('loans.approve');
        Route::post('loans/{loan}/reject', [AdminLoanController::class, 'reject'])->name('loans.reject');

        Route::get('returns', [AdminReturnController::class, 'index'])->name('returns.index');
        Route::post('returns/{return}/approve', [AdminReturnController::class, 'approve'])->name('returns.approve');
        Route::post('returns/{return}/reject', [AdminReturnController::class, 'reject'])->name('returns.reject');
    });

    Route::middleware(['role:Anggota'])->prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

        Route::get('/books', [MemberLoanController::class, 'listBooks'])->name('books.index');
        Route::get('/books/{book}', [MemberLoanController::class, 'show'])->name('books.show');
        Route::get('/loans', [MemberLoanController::class, 'index'])->name('loans.index');
        Route::post('/loans', [MemberLoanController::class, 'store'])->name('loans.store');
        Route::post('/loans/{loan}/return-request', [MemberLoanController::class, 'requestReturn'])
            ->name('loans.return-request');
    });
});

require __DIR__.'/auth.php';
