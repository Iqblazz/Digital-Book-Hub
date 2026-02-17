<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get(); 
        return view('Books.index', compact('books'));
    }

    public function create()
    {
        return view('Books.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'book_code'      => 'required|unique:books,book_code',
        'name'           => 'required|string|max:255',
        'author'         => 'required|string|max:255',
        'published_year' => 'required|integer|min:1900|max:'.date('Y'),
        'stock'          => 'required|integer|min:0',
        'price'          => 'required|numeric|min:0',
    ]);

    Book::create([
        'book_code'      => $request->book_code,
        'name'           => $request->name,
        'author'         => $request->author,
        'published_year' => $request->published_year,
        'stock'          => $request->stock,
        'price'          => $request->price,
        'user_id'        => auth()->id(),
    ]);

    return redirect()->route('books.index')->with('success', 'Book added successfully!');
}

    public function edit(Book $book)
    {
        return view('Books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'year' => 'nullable|numeric',
            'book_code' => 'required|unique:books,book_code,' . $book->id,
            'stock' => 'required|numeric',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}