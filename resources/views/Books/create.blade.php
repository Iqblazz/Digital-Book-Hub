@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Book</h1>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Add Book Data</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Book Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Published Year</label>
                    <input type="number" name="published_year" class="form-control @error('published_year') is-invalid @enderror" value="{{ old('published_year', date('Y')) }}" min="1900" max="{{ date('Y') }}" required>
                    @error('published_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Book Code (ISBN)</label>
                    <input type="text" name="book_code" class="form-control @error('book_code') is-invalid @enderror" value="{{ old('book_code') }}" required>
                    @error('book_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Stock</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" min="0"  required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="price" value="0">

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50"></i> Save Book
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary shadow-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection