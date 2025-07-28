@extends('layouts.admin')

@section('title', 'Manage Hotels - Sawah Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="card-title h3 mb-0">Manage Hotels</h1>
                        <a href="{{ route('admin.hotels.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Add New Hotel
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Stars</th>
                                    <th>Price/Night</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hotels as $hotel)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($hotel->image)
                                                    <img class="rounded-circle me-3" src="{{ $hotel->image }}" alt="{{ $hotel->name }}" width="40" height="40" style="object-fit: cover;">
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $hotel->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $hotel->country->name }}</td>
                                        <td>
                                            <span class="badge bg-warning text-dark">{{ $hotel->stars }}★</span>
                                        </td>
                                        <td>SAR {{ $hotel->price_per_night }}</td>
                                        <td>{{ Str::limit($hotel->description, 100) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.hotels.show', $hotel) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this hotel?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p>No hotels found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($hotels->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $hotels->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 