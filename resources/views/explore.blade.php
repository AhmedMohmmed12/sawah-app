@extends('layouts.app')

@section('title', 'Destinations: '.$total.' countries by daily budget | Sawah')

@section('content')
<div class="page-head">
    <div class="wrap">
        <div class="crumbs"><a href="{{ route('home') }}">Home</a><span>/</span><span>Destinations</span></div>
        <h1>Destinations</h1>
        <p>{{ $total }} countries with a typical mid-range daily budget per person in riyals: hotel, food, local transport and entry fees, without flights.</p>
    </div>
</div>

<div class="wrap">
    <form class="filters filters-top" method="GET" action="{{ route('explore') }}">
        <div class="field">
            <label class="label" for="region">Region</label>
            <select class="select" id="region" name="region">
                <option value="">All regions</option>
                @foreach ($regions as $region)
                    <option value="{{ $region }}" @selected(($filters['region'] ?? '') === $region)>{{ $region }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label class="label" for="climate">Climate</label>
            <select class="select" id="climate" name="climate">
                <option value="">Any climate</option>
                @foreach (['Warm', 'Mild', 'Cold'] as $climate)
                    <option value="{{ $climate }}" @selected(($filters['climate'] ?? '') === $climate)>{{ $climate }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label class="label" for="max_budget">Max. daily budget</label>
            <div class="input-group">
                <span class="addon">SAR</span>
                <input class="input" type="number" id="max_budget" name="max_budget" min="0" step="50" placeholder="Any" value="{{ $filters['max_budget'] ?? '' }}">
            </div>
        </div>
        <div class="field">
            <label class="label" for="sort">Sort by</label>
            <select class="select" id="sort" name="sort">
                <option value="budget" @selected(($filters['sort'] ?? 'budget') === 'budget')>Budget, low to high</option>
                <option value="budget_desc" @selected(($filters['sort'] ?? '') === 'budget_desc')>Budget, high to low</option>
                <option value="name" @selected(($filters['sort'] ?? '') === 'name')>Name</option>
            </select>
        </div>
        <button class="btn btn-dark" type="submit"><x-icon name="filter" size="sm" />Apply</button>
        @if (array_filter($filters))
            <a class="btn btn-ghost" href="{{ route('explore') }}">Clear</a>
        @endif
    </form>

    <p class="result-count">
        @if ($countries->count() === $total)
            Showing all {{ $total }} countries
        @else
            {{ $countries->count() }} of {{ $total }} countries match
        @endif
    </p>

    @if ($countries->isEmpty())
        <div class="empty">
            <h3>Nothing matches those filters</h3>
            <p>Try a higher budget or a different region.</p>
            <a class="btn btn-outline" href="{{ route('explore') }}">Show all countries</a>
        </div>
    @else
        <div class="grid">
            @foreach ($countries as $country)
                <x-dest-tile :country="$country" />
            @endforeach
        </div>
    @endif
</div>
@endsection
