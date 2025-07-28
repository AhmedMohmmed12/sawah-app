@extends('layouts.admin')

@section('title', 'Manage Attractions - Sawah Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="card-title h3 mb-0">Manage Attractions</h1>
                        <a href="{{ route('admin.attractions.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Add New Attraction
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
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attractions as $attraction)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($attraction->image)
                                                    <img class="rounded-circle me-3" src="{{ $attraction->image }}" alt="{{ $attraction->name }}" width="40" height="40" style="object-fit: cover;">
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $attraction->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $attraction->country->name }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $attraction->type }}</span>
                                        </td>
                                        <td>{{ Str::limit($attraction->description, 100) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.attractions.show', $attraction) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.attractions.edit', $attraction) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.attractions.destroy', $attraction) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this attraction?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p>No attractions found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($attractions->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $attractions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 