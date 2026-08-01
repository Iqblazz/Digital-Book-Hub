<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = \App\Models\User::where('id', '!=', auth()->id())->get();
        $books = \App\Models\Book::where('stock', '>', 0)->get();
        return view('borrowings.create', compact('users', 'books'));
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after_or_equal:borrow_date',
    ], [
        'return_date.after_or_equal' => 'The return date must be a date after or equal to the borrow date.',
    ]);

    $book = Book::find($request->book_id);
    if (!$book || $book->stock <= 0) {
        return redirect()->back()->with('error', 'Book stock is empty.');
    }

    $book->decrement('stock');
    Borrowing::create($request->all());

    return redirect()->route('borrowings.index')->with('success', 'Transaction added successfully!');
}

    // FUNGSI BARU: Buat balikin buku
    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status !== 'returned') {

            $borrowing->update(['status' => 'returned']);

            $borrowing->book->increment('stock');

            return redirect()->back()->with('success', 'The book has been successfully returned!');
        }

        return redirect()->back()->with('error', 'The book has already been returned previously.');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'returned') {
            $borrowing->book->increment('stock');
        }

        $borrowing->delete();
        return redirect()->back()->with('success', 'The borrowing data has been successfully deleted!');
    }
}