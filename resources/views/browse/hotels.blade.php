@extends('layouts.app')

@section('title', 'Hotels | Sawah')

@section('content')
<div class="page-head">
    <div class="wrap">
        <div class="crumbs"><a href="{{ route('home') }}">Home</a><span>/</span><span>Hotels</span></div>
        <h1>Hotels</h1>
        <p>Well-known hotels in each country with their official star rating. Prices are typical starting rates per night in riyals and change with the season.</p>
    </div>
</div>

<div class="wrap">
    <form class="filters filters-top" method="GET" action="{{ route('hotels.index') }}">
        <div class="field">
            <label class="label" for="country">Country</label>
            <select class="select" id="country" name="country">
                <option value="">All countries</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->slug }}" @selected(($filters['country'] ?? '') === $country->slug)>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label class="label" for="stars">Stars</label>
            <select class="select" id="stars" name="stars">
                <option value="">Any</option>
                <option value="4" @selected(($filters['stars'] ?? '') == 4)>4 stars and up</option>
                <option value="5" @selected(($filters['stars'] ?? '') == 5)>5 stars</option>
            </select>
        </div>
        <div class="field">
            <label class="label" for="max_price">Max. per night</label>
            <div class="input-group">
                <span class="addon">SAR</span>
                <input class="input" type="number" id="max_price" name="max_price" min="0" step="100" placeholder="Any" value="{{ $filters['max_price'] ?? '' }}">
            </div>
        </div>
        <div class="field">
            <label class="label" for="sort">Sort by</label>
            <select class="select" id="sort" name="sort">
                <option value="price" @selected(($filters['sort'] ?? 'price') === 'price')>Price, low to high</option>
                <option value="price_desc" @selected(($filters['sort'] ?? '') === 'price_desc')>Price, high to low</option>
                <option value="name" @selected(($filters['sort'] ?? '') === 'name')>Name</option>
            </select>
        </div>
        <button class="btn btn-dark" type="submit"><x-icon name="filter" size="sm" />Apply</button>
        @if (array_filter($filters))
            <a class="btn btn-ghost" href="{{ route('hotels.index') }}">Clear</a>
        @endif
    </form>

    <p class="result-count">{{ $hotels->total() }} {{ Str::plural('hotel', $hotels->total()) }}</p>

    @if ($hotels->isEmpty())
        <div class="empty">
            <h3>No hotels match</h3>
            <p>Try a higher price or another country.</p>
            <a class="btn btn-outline" href="{{ route('hotels.index') }}">Show all hotels</a>
        </div>
    @else
        <div class="grid">
            @foreach ($hotels as $hotel)
                <x-hotel-card :hotel="$hotel" :show-country="empty($filters['country'])" />
            @endforeach
        </div>
        {{ $hotels->links() }}
    @endif
</div>
@endsection
