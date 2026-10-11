@extends('layouts.app')

@section('title', 'Sawah: find where your budget takes you')

@section('content')
@php $heroCountry = $featured->firstWhere('slug', 'turkey') ?? $featured->first(); @endphp

<div class="hero" @if ($heroCountry) style="background-image: url('{{ $heroCountry->image_url }}')" @endif>
    <div class="wrap">
        <h1>Where should you <em>go next?</em></h1>
        <p>Tell us what you can spend a day. We'll show you which countries fit.</p>
    </div>
    @if ($heroCountry)
        <span class="credit">{{ $heroCountry->image_caption }} · Photo: {{ $heroCountry->image_credit }}</span>
    @endif
</div>

<div class="wrap">
    <x-search-card :values="$search" />

    <div class="quick">
        <a class="q" href="{{ route('explore') }}">
            <span class="ic"><x-icon name="globe" size="lg" /></span>
            <div><b>{{ $counts['countries'] }} countries</b><span>Budgets in riyals per day</span></div>
        </a>
        <a class="q" href="{{ route('hotels.index') }}">
            <span class="ic"><x-icon name="bed" size="lg" /></span>
            <div><b>{{ $counts['hotels'] }} hotels</b><span>From SAR {{ number_format($counts['hotel_from'] ?? 0) }} a night</span></div>
        </a>
        <a class="q" href="{{ route('attractions.index') }}">
            <span class="ic"><x-icon name="ticket" size="lg" /></span>
            <div><b>{{ $counts['attractions'] }} things to do</b><span>Sights, nature, beaches</span></div>
        </a>
        <div class="q">
            <span class="ic"><x-icon name="coins" size="lg" /></span>
            <div><b>Exchange rates</b><span>{{ $ratesUpdated ? 'Updated '.$ratesUpdated->diffForHumans() : 'Updated daily' }}</span></div>
        </div>
    </div>

    <x-rail title="Popular destinations" subtitle="Where Saudi travellers go most, priced in riyals per day." :href="route('explore')" link-text="All {{ $counts['countries'] }} countries">
        @foreach ($featured as $country)
            <x-dest-tile :country="$country" />
        @endforeach
    </x-rail>

    <x-rail title="Top hotels" subtitle="Official star ratings. Prices are typical starting rates per night." :href="route('hotels.index')">
        @foreach ($hotels as $hotel)
            <x-hotel-card :hotel="$hotel" />
        @endforeach
    </x-rail>
</div>

<section class="band">
    <div class="wrap section">
        <div class="s-head">
            <div>
                <h2>Where your riyal goes furthest</h2>
                <p>Sorted by daily budget, cheapest first.</p>
            </div>
            <div class="acts"><a class="all" href="{{ route('explore') }}">See all {{ $counts['countries'] }}</a></div>
        </div>
        <div class="list">
            @foreach ($cheapest as $country)
                <a class="lrow" href="{{ route('country.show', $country->slug) }}">
                    <span class="no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="nm">{{ $country->name }}</span>
                    <span class="nt">{{ Str::before($country->description, '. ') }}.</span>
                    <span class="fx"><span>SAR/day</span>{{ number_format($country->daily_budget_min) }}–{{ number_format($country->daily_budget_max) }}<br><span>Climate</span>{{ $country->climate }} · {{ $country->currency }}</span>
                    <div class="th"><img src="{{ $country->image_url }}" alt="" loading="lazy"></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<div class="wrap">
    <x-rail title="Things to do" subtitle="A few picks from across the list. They change every day." :href="route('attractions.index')">
        @foreach ($attractions as $attraction)
            <x-attraction-card :attraction="$attraction" />
        @endforeach
    </x-rail>

    @php $promo = $featured->firstWhere('slug', 'georgia') ?? $featured->last(); @endphp
    <div class="promo">
        <div class="txt">
            <h3>Not sure where to go?</h3>
            <p>Give the trip planner a daily budget, the weather you like and the kind of trip you want. It shows which countries fit and why, with hotels and things to do for each.</p>
            <a class="btn" href="{{ route('destination.suggest') }}">Open the trip planner <x-icon name="arrow-right" size="sm" /></a>
        </div>
        @if ($promo)
            <div class="ph"><img src="{{ $promo->image_url }}" alt="{{ $promo->image_caption }}" loading="lazy"></div>
        @endif
    </div>
</div>
@endsection
