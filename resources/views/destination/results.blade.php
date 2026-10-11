@extends('layouts.app')

@section('title', 'Trip planner results | Sawah')

@php
    $budgetText = $criteria['budget_max'] !== null
        ? 'SAR '.number_format($criteria['budget_min'] ?? 0).'–'.number_format($criteria['budget_max']).' a day'
        : 'any budget';
    $weatherText = $criteria['weather'] === 'No preference' ? 'any weather' : strtolower($criteria['weather']).' weather';
@endphp

@section('content')
<div class="page-head">
    <div class="wrap">
        <div class="crumbs"><a href="{{ route('home') }}">Home</a><span>/</span><a href="{{ route('destination.suggest') }}">Trip planner</a><span>/</span><span>Results</span></div>
        <h1>
            @if ($relaxed)
                No exact matches
            @else
                {{ $results->count() }} {{ Str::plural('country', $results->count()) }} fit
            @endif
        </h1>
        <p>{{ $criteria['trip_type'] ? $criteria['trip_type'].' trip' : 'Any trip' }}, {{ $budgetText }}, {{ $weatherText }}.</p>
    </div>
</div>

<div class="wrap">
    <div class="section">
        <x-search-card :values="$criteria" />
    </div>

    <div class="section">
        @if ($relaxed)
            <div class="alert alert-info"><x-icon name="info" /><div>Nothing matched every condition, so these are the closest options. Try widening your budget or choosing "Any weather".</div></div>
        @endif

        @foreach ($results as $result)
            @php $country = $result->country; @endphp
            <article class="result">
                <a class="ph" href="{{ route('country.show', $country->slug) }}">
                    <img src="{{ $country->image_url }}" alt="{{ $country->image_caption ?? $country->name }}" loading="lazy">
                    <span class="rank">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </a>
                <div class="body">
                    <h3><a href="{{ route('country.show', $country->slug) }}">{{ $country->name }}</a></h3>
                    <p class="sub">{{ $country->region }} · {{ $country->capital }} · Best {{ $country->best_months }}</p>
                    <ul class="why">
                        <li class="{{ $result->budgetFits ? '' : 'miss' }}">
                            <x-icon :name="$result->budgetFits ? 'check' : 'x'" size="sm" />
                            <span>Daily budget SAR {{ number_format($country->daily_budget_min) }}–{{ number_format($country->daily_budget_max) }}{{ $result->budgetFits ? '' : ', outside your range' }}</span>
                        </li>
                        <li class="{{ $result->weatherFits ? '' : 'miss' }}">
                            <x-icon :name="$result->weatherFits ? 'check' : 'x'" size="sm" />
                            <span>{{ $country->climate }} climate</span>
                        </li>
                        @if ($criteria['trip_type'])
                            <li class="{{ $result->matching->isNotEmpty() ? '' : 'miss' }}">
                                <x-icon :name="$result->matching->isNotEmpty() ? 'check' : 'x'" size="sm" />
                                <span>
                                    @if ($result->matching->isNotEmpty())
                                        Good for a {{ strtolower($criteria['trip_type']) }} trip: {{ $result->matching->pluck('name')->take(3)->join(', ', ' and ') }}
                                    @else
                                        Fewer {{ strtolower($criteria['trip_type']) }} activities on our list
                                    @endif
                                </span>
                            </li>
                        @endif
                    </ul>
                    <div class="foot">
                        <span class="muted small">{{ $country->hotels_count }} hotels · {{ $country->attractions->count() }} things to do</span>
                        <a class="btn" href="{{ route('country.show', $country->slug) }}">See {{ $country->name }} <x-icon name="arrow-right" size="sm" /></a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>
@endsection
