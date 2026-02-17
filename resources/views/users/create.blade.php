@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New User</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Add Data User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="none" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="off" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" minlength="8" autocomplete="new-password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Minimum 8 characters.</small>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50"></i> Save User
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary shadow-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection