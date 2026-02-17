<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Http\Resources\BorrowingResource;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        
        return BorrowingResource::collection($borrowings)->additional([
            'success' => true
        ]);
    }

    public function store(Request $request)
    {
        $book = Book::find($request->book_id);

        if ($book && $book->stock > 0) {
            $book->decrement('stock');

            $borrowing = Borrowing::create([
                'user_id'     => $request->user_id,
                'book_id'     => $request->book_id,
                'borrow_date' => now(),
                'return_date' => $request->return_date,
                'status'      => 'borrowed'
            ]);

            return (new BorrowingResource($borrowing))->additional([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Stock Empty'
        ], 400);
    }

    public function show($id)
    {
        $borrowing = Borrowing::with(['user', 'book'])->find($id);

        if (!$borrowing) {
            return response()->json([
                'success' => false, 
                'message' => 'Not Found'
            ], 404);
        }

        return (new BorrowingResource($borrowing))->additional([
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return response()->json([
                'success' => false, 
                'message' => 'Not Found'
            ], 404);
        }

        $borrowing->update($request->all());

        return (new BorrowingResource($borrowing))->additional([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return response()->json([
                'success' => false, 
                'message' => 'Not Found'
            ], 404);
        }

        $borrowing->delete();

        return response()->json([
            'success' => true, 
            'message' => 'Deleted'
        ], 200);
    }
}