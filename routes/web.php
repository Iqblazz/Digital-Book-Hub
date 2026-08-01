<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function (Illuminate\Http\Request $request) {
        $year = $request->get('year', date('Y'));

        $totalUsers = \App\Models\User::where('id', '!=', auth()->id())->count();
        $totalBooks = \App\Models\Book::sum('stock');

        // Angka statistik yang difilter
        $totalBorrowings = \App\Models\Borrowing::whereYear('borrow_date', $year)->count();
        $overdueCount = \App\Models\Borrowing::where('status', 'borrowed')
            ->whereYear('borrow_date', $year)
            ->where('return_date', '<', \Carbon\Carbon::today())
            ->count();

        // DATA LAPORAN TAHUNAN (Semua transaksi di tahun tersebut)
        $yearlyReport = \App\Models\Borrowing::with(['user', 'book'])
            ->whereYear('borrow_date', $year)
            ->latest()
            ->get();

        return view('dashboard', compact('totalUsers', 'totalBooks', 'totalBorrowings', 'overdueCount', 'year', 'yearlyReport'));
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('borrowings', BorrowingController::class);
    Route::patch('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';