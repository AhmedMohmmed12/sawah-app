@extends('layouts.admin')

@section('title', 'Add Country - Sawah Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="card-title h3 mb-0">Add New Country</h1>
                        <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Countries
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.countries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Country Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="code" class="form-label">Country Code</label>
                                <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}" required maxlength="3">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" class="form-control" name="currency" id="currency" value="{{ old('currency') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exchange_rate_to_sar" class="form-label">Exchange Rate to SAR</label>
                                <input type="number" class="form-control" name="exchange_rate_to_sar" id="exchange_rate_to_sar" value="{{ old('exchange_rate_to_sar') }}" required step="0.01" min="0">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="climate" class="form-label">Climate</label>
                                <input type="text" class="form-control" name="climate" id="climate" value="{{ old('climate') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="daily_budget_min" class="form-label">Daily Budget Min (SAR)</label>
                                <input type="number" class="form-control" name="daily_budget_min" id="daily_budget_min" value="{{ old('daily_budget_min') }}" required step="0.01" min="0">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="daily_budget_max" class="form-label">Daily Budget Max (SAR)</label>
                                <input type="number" class="form-control" name="daily_budget_max" id="daily_budget_max" value="{{ old('daily_budget_max') }}" required step="0.01" min="0">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="image" class="form-label">Country Image</label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Country
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 