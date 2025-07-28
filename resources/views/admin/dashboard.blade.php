@extends('layouts.admin')

@section('title', 'Admin Dashboard - Sawah')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title h3 mb-4">Admin Dashboard</h1>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-2 col-sm-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Countries</h5>
                                    <h2 class="display-6">{{ $stats['total_countries'] }}</h2>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Attractions</h5>
                                    <h2 class="display-6">{{ $stats['total_attractions'] }}</h2>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-6 mb-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Hotels</h5>
                                    <h2 class="display-6">{{ $stats['total_hotels'] }}</h2>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-6 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Users</h5>
                                    <h2 class="display-6">{{ $stats['total_users'] }}</h2>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-6 mb-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Managers</h5>
                                    <h2 class="display-6">{{ $stats['total_managers'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mb-4">
                        <h4 class="mb-3">Quick Actions</h4>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Country
                            </a>
                            <a href="{{ route('admin.attractions.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Add Attraction
                            </a>
                            <a href="{{ route('admin.hotels.create') }}" class="btn btn-warning">
                                <i class="fas fa-plus me-2"></i>Add Hotel
                            </a>
                        </div>
                    </div>

                    <!-- Recent Data -->
                    <div class="row">
                        <!-- Recent Countries -->
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Recent Countries</h5>
                                </div>
                                <div class="card-body">
                                    @if($recentCountries->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($recentCountries as $country)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $country->name }}</span>
                                                    <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No countries found.</p>
                                    @endif
                                    <a href="{{ route('admin.countries.index') }}" class="btn btn-link p-0 mt-2">View All Countries</a>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Attractions -->
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Recent Attractions</h5>
                                </div>
                                <div class="card-body">
                                    @if($recentAttractions->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($recentAttractions as $attraction)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="fw-bold">{{ $attraction->name }}</div>
                                                        <small class="text-muted">{{ $attraction->country->name }}</small>
                                                    </div>
                                                    <a href="{{ route('admin.attractions.edit', $attraction) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No attractions found.</p>
                                    @endif
                                    <a href="{{ route('admin.attractions.index') }}" class="btn btn-link p-0 mt-2">View All Attractions</a>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Hotels -->
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Recent Hotels</h5>
                                </div>
                                <div class="card-body">
                                    @if($recentHotels->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($recentHotels as $hotel)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="fw-bold">{{ $hotel->name }}</div>
                                                        <small class="text-muted">{{ $hotel->country->name }} - {{ $hotel->stars }}★</small>
                                                    </div>
                                                    <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No hotels found.</p>
                                    @endif
                                    <a href="{{ route('admin.hotels.index') }}" class="btn btn-link p-0 mt-2">View All Hotels</a>
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