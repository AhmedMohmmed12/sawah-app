@extends('layouts.admin')

@section('title', 'Admin Profile - Sawah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-shield me-2"></i>
                        Admin Profile Management
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Profile Information -->
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user me-2"></i>
                                        Profile Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('admin.profile.update') }}">
                                        @csrf
                                        @method('patch')

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" 
                                                       class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" 
                                                       name="name" 
                                                       value="{{ old('name', $user->name) }}" 
                                                       required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" 
                                                       name="email" 
                                                       value="{{ old('email', $user->email) }}" 
                                                       required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Change Password -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-lock me-2"></i>
                                        Change Password
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('put')

                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" 
                                                   class="form-control @error('current_password') is-invalid @enderror" 
                                                   id="current_password" 
                                                   name="current_password" 
                                                   required>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="password" class="form-label">New Password</label>
                                                <input type="password" 
                                                       class="form-control @error('password') is-invalid @enderror" 
                                                       id="password" 
                                                       name="password" 
                                                       required>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                                <input type="password" 
                                                       class="form-control" 
                                                       id="password_confirmation" 
                                                       name="password_confirmation" 
                                                       required>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fas fa-key me-2"></i>
                                                Update Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Account -->
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Delete Account
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        Once your account is deleted, all of its resources and data will be permanently deleted.
                                    </div>
                                    
                                    <form method="post" action="{{ route('admin.profile.destroy') }}">
                                        @csrf
                                        @method('delete')

                                        <div class="mb-3">
                                            <label for="password_delete" class="form-label">Password</label>
                                            <input type="password" 
                                                   class="form-control @error('password') is-invalid @enderror" 
                                                   id="password_delete" 
                                                   name="password" 
                                                   placeholder="Enter your password to confirm">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                                <i class="fas fa-trash me-2"></i>
                                                Delete Account
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <!-- Profile Summary -->
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-user-shield fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="text-muted">{{ $user->email }}</p>
                                    <span class="badge bg-primary">Administrator</span>
                                    <p class="text-muted mt-2">Member since {{ $user->created_at->format('M Y') }}</p>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-bolt me-2"></i>
                                        Quick Actions
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-tachometer-alt me-2"></i>
                                            Admin Dashboard
                                        </a>
                                        <a href="{{ route('admin.countries.index') }}" class="btn btn-outline-success">
                                            <i class="fas fa-flag me-2"></i>
                                            Manage Countries
                                        </a>
                                        <a href="{{ route('admin.attractions.index') }}" class="btn btn-outline-info">
                                            <i class="fas fa-camera me-2"></i>
                                            Manage Attractions
                                        </a>
                                        <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline-warning">
                                            <i class="fas fa-bed me-2"></i>
                                            Manage Hotels
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 