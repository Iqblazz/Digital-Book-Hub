@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Book</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Book: {{ $book->name }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                     <div class="form-group mb-3">
                    <label class="font-weight-bold">Book Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $book->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="form-group mb-3">
                    <label class="font-weight-bold">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $book->author) }}">
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
               <div class="form-group mb-3">
                    <label class="font-weight-bold">Year</label>
                    <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $book->year) }}"> {{-- Atribut 'required' dihapus --}}
                    @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Book Code</label>
                    <input type="text" name="book_code" class="form-control @error('book_code') is-invalid @enderror" value="{{ old('book_code', $book->book_code) }}" required>
                    @error('book_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">Stock</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $book->stock) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm px-4">
                        <i class="fas fa-save fa-sm text-white-50"></i> Save Changes
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary shadow-sm px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection