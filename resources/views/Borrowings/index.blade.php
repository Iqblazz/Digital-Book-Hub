@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Borrowing Management</h1>
        <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Transaction
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-left-success shadow" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Borrowing Transaction List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Borrower Name</th>
                            <th>Book Title</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center" width="12%">Status</th>
                            <th class="text-center" width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $borrow)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle font-weight-bold text-dark">
                                {{ $borrow->user->name ?? 'Unknown User' }}
                            </td>
                            <td class="align-middle">{{ $borrow->book->name ?? 'Unknown Book' }}</td>
                            <td class="align-middle text-center">
                                {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $borrow->return_date ? \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') : '-' }}
                            </td>
                            
                            {{-- Kolom Status - Sekarang Sudah di Tengah --}}
                            <td class="align-middle text-center">
                                @if($borrow->status === 'overdue')
                                    <span class="badge badge-danger p-2 shadow-sm" style="min-width: 85px;">
                                        <i class="fas fa-exclamation-circle mr-1"></i> OVERDUE
                                    </span>
                                @elseif($borrow->status === 'returned')
                                    <span class="badge badge-success p-2 shadow-sm" style="min-width: 85px;">
                                        <i class="fas fa-check-circle mr-1"></i> RETURNED
                                    </span>
                                @else
                                    <span class="badge badge-primary p-2 shadow-sm" style="min-width: 85px;">
                                        <i class="fas fa-book-reader mr-1"></i> BORROWED
                                    </span>
                                @endif
                            </td>

                            {{-- Kolom Action --}}
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center">
                                    {{-- Tombol Return (Hanya Ikon) --}}
                                    @if($borrow->status !== 'returned')
                                        <form action="{{ route('borrowings.return', $borrow->id) }}" method="POST" class="mr-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm shadow-sm" title="Return Book">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Tombol Delete (Hanya Ikon) --}}
                                    <form action="{{ route('borrowings.destroy', $borrow->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this log?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm" title="Delete Log">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No borrowing data found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection