@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Book Management</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Book
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-left-success shadow" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Book Name</th>
                            <th>Author</th>
                            <th width="10%">Year</th>
                            <th width="15%">Book Code</th>
                            <th width="10%">Stock</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle"><strong>{{ $book->name }}</strong></td>
                            <td class="align-middle">{{ $book->author }}</td>
                            <td class="align-middle">{{ $book->published_year }}</td>
                            <td class="align-middle">
                                <span class="badge badge-dark p-2" style="background-color: #5a5c69; font-family: 'Courier New', Courier, monospace;">
                                    {{ $book->book_code }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $book->stock }} <small class="text-muted">pcs</small></td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center" style="gap: 5px;">
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku {{ $book->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection