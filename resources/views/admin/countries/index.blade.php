@extends('layouts.admin')

@section('title', 'Manage Countries - Sawah Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="card-title h3 mb-0">Manage Countries</h1>
                        <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Country
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
                                    <th>Code</th>
                                    <th>Currency</th>
                                    <th>Climate</th>
                                    <th>Attractions</th>
                                    <th>Hotels</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $country)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($country->image)
                                                    <img class="rounded-circle me-3" src="{{ $country->image_url }}" alt="{{ $country->name }}" width="40" height="40" style="object-fit: cover;">
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $country->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $country->code }}</td>
                                        <td>{{ $country->currency }}</td>
                                        <td>{{ $country->climate }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $country->attractions_count }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $country->hotels_count }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.countries.show', $country) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this country?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p>No countries found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($countries->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $countries->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 