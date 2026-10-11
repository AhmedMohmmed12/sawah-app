@extends('layouts.app')

@section('title', 'Things to do | Sawah')

@section('content')
<div class="page-head">
    <div class="wrap">
        <div class="crumbs"><a href="{{ route('home') }}">Home</a><span>/</span><span>Things to do</span></div>
        <h1>Things to do</h1>
        <p>Sights, nature, beaches and days out in every country on the list.</p>
    </div>
</div>

<div class="wrap">
    <form class="filters filters-top" method="GET" action="{{ route('attractions.index') }}">
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
            <label class="label" for="type">Type</label>
            <select class="select" id="type" name="type">
                <option value="">All types</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(($filters['type'] ?? '') === $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-dark" type="submit"><x-icon name="filter" size="sm" />Apply</button>
        @if (array_filter($filters))
            <a class="btn btn-ghost" href="{{ route('attractions.index') }}">Clear</a>
        @endif
    </form>

    <p class="result-count">{{ $attractions->total() }} {{ Str::plural('place', $attractions->total()) }}</p>

    @if ($attractions->isEmpty())
        <div class="empty">
            <h3>Nothing here yet</h3>
            <p>Try another type or country.</p>
            <a class="btn btn-outline" href="{{ route('attractions.index') }}">Show everything</a>
        </div>
    @else
        <div class="grid">
            @foreach ($attractions as $attraction)
                <a class="card" href="{{ route('country.show', $attraction->country->slug) }}#see">
                    <div class="ph">
                        <img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" loading="lazy">
                        <span class="badge">{{ $attraction->type }}</span>
                    </div>
                    <div class="body">
                        <h3 title="{{ $attraction->name }}">{{ $attraction->name }}</h3>
                        <div class="loc"><x-icon name="pin" size="sm" />{{ collect([$attraction->city, $attraction->country->name])->filter()->unique()->join(', ') }}</div>
                        <p class="desc">{{ $attraction->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        {{ $attractions->links() }}
    @endif
</div>
@endsection
