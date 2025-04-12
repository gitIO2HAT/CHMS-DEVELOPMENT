@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Add New User</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Enter full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Enter email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter password" required>
                            <small class="form-text text-muted">Password must be at least 8 characters long.</small>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select name="role" id="role" class="form-select form-select-lg" required>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-user-plus"></i> Add User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection