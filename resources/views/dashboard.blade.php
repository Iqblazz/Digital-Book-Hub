@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
        
        <form action="{{ route('dashboard') }}" method="GET" class="form-inline">
            <div class="input-group shadow-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white text-primary border-right-0 small font-weight-bold">Year:</span>
                </div>
                <select name="year" class="form-control border-left-0 border-right-0 bg-white small">
                    @for ($i = date('Y'); $i >= 2024; $i--)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <div class="input-group-append">
                    <button class="btn btn-white border-left-0 text-primary" type="submit" style="background-color: white;">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Book Stock</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBooks }} Units</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Borrowed ({{ $year }})</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBorrowings }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Overdue ({{ $year }})</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $overdueCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-table mr-2"></i> Annual Borrowing Report - {{ $year }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Borrower</th>
                                    <th>Book Title</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($yearlyReport as $report)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $report->user->name ?? 'N/A' }}</td>
                                    <td class="align-middle">{{ $report->book->name ?? 'N/A' }}</td>
                                    <td class="text-center align-middle">
                                        {{ \Carbon\Carbon::parse($report->borrow_date)->format('d M Y') }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-{{ $report->status == 'overdue' ? 'danger' : ($report->status == 'returned' ? 'success' : 'primary') }} p-2">
                                            {{ strtoupper($report->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center py-4">No data available for the selected year.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection