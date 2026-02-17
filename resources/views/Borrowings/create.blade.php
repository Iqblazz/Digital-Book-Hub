@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Transaction</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('borrowings.store') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Select User</label>
                <select name="user_id" class="form-control" required>
                    <option value="" disabled selected>-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Select Book</label>
                <select name="book_id" class="form-control" required>
                    <option value="" disabled selected>-- Select Book --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->name }} (Stock: {{ $book->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Borrow Start Date</label>
                        <input type="date" id="borrow_date" name="borrow_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Borrow End Date (Return)</label>
                        <input type="date" id="return_date" name="return_date" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Save Transaction</button>
            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    const startInput = document.getElementById('borrow_date');
    const endInput = document.getElementById('return_date');

    endInput.min = startInput.value;

    startInput.addEventListener('change', function() {
        endInput.min = this.value;
        if (endInput.value < this.value) {
            endInput.value = this.value;
        }
    });
</script>
@endsection