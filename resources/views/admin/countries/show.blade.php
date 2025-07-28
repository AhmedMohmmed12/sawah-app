@extends('layouts.admin')

@section('title', 'Country Details - Sawah Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="card-title h3 mb-0">Country Details: {{ $country->name }}</h1>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Edit Country
                            </a>
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Countries
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Country Information -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Country Information</h5>
                                </div>
                                <div class="card-body">
                                    @if($country->image)
                                        <div class="mb-4 text-center">
                                            <img src="{{ $country->image }}" alt="{{ $country->name }}" class="img-fluid rounded" style="max-height: 300px;">
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Name</label>
                                            <p class="form-control-plaintext">{{ $country->name }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Code</label>
                                            <p class="form-control-plaintext">{{ $country->code }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Currency</label>
                                            <p class="form-control-plaintext">{{ $country->currency }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Exchange Rate to SAR</label>
                                            <p class="form-control-plaintext">{{ $country->exchange_rate_to_sar }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Climate</label>
                                            <p class="form-control-plaintext">{{ $country->climate }}</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Daily Budget Range</label>
                                            <p class="form-control-plaintext">SAR {{ $country->daily_budget_min }} - {{ $country->daily_budget_max }}</p>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Description</label>
                                            <p class="form-control-plaintext">{{ $country->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Data -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Related Data</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Attractions -->
                                    <div class="mb-4">
                                        <h6 class="fw-bold">Attractions ({{ $country->attractions->count() }})</h6>
                                        @if($country->attractions->count() > 0)
                                            <div class="list-group list-group-flush">
                                                @foreach($country->attractions->take(5) as $attraction)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <div class="fw-bold">{{ $attraction->name }}</div>
                                                            <small class="text-muted">{{ $attraction->type }}</small>
                                                        </div>
                                                        <a href="{{ route('admin.attractions.edit', $attraction) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if($country->attractions->count() > 5)
                                                <p class="text-muted mt-2">And {{ $country->attractions->count() - 5 }} more...</p>
                                            @endif
                                        @else
                                            <p class="text-muted">No attractions found.</p>
                                        @endif
                                        <a href="{{ route('admin.attractions.create') }}?country_id={{ $country->id }}" class="btn btn-sm btn-success mt-2">
                                            <i class="fas fa-plus me-1"></i>Add Attraction
                                        </a>
                                    </div>

                                    <!-- Hotels -->
                                    <div>
                                        <h6 class="fw-bold">Hotels ({{ $country->hotels->count() }})</h6>
                                        @if($country->hotels->count() > 0)
                                            <div class="list-group list-group-flush">
                                                @foreach($country->hotels->take(5) as $hotel)
                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <div class="fw-bold">{{ $hotel->name }}</div>
                                                            <small class="text-muted">{{ $hotel->country->name }} - {{ $hotel->stars }}★</small>
                                                        </div>
                                                        <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if($country->hotels->count() > 5)
                                                <p class="text-muted mt-2">And {{ $country->hotels->count() - 5 }} more...</p>
                                            @endif
                                        @else
                                            <p class="text-muted">No hotels found.</p>
                                        @endif
                                        <a href="{{ route('admin.hotels.create') }}?country_id={{ $country->id }}" class="btn btn-sm btn-warning mt-2">
                                            <i class="fas fa-plus me-1"></i>Add Hotel
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