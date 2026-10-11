@extends('layouts.app')

@section('title', $country->name.': budget, hotels and things to do | Sawah')
@section('description', Str::limit($country->description, 155))

@section('content')
<div class="page-head has-photo" style="background-image: url('{{ $country->image_url }}')">
    <div class="wrap">
        <div class="crumbs">
            <a href="{{ route('home') }}">Home</a><span>/</span>
            <a href="{{ route('explore') }}">Destinations</a><span>/</span>
            @if ($country->region)<a href="{{ route('explore', ['region' => $country->region]) }}">{{ $country->region }}</a><span>/</span>@endif
            <span>{{ $country->name }}</span>
        </div>
        <h1>{{ $country->name }}</h1>
    </div>
    @if ($country->image_credit)
        <span class="credit">{{ $country->image_caption }} · Photo: {{ $country->image_credit }}</span>
    @endif
</div>

<div class="wrap">
    <div class="facts">
        <div><small>Daily budget</small><b>SAR {{ number_format($country->daily_budget_min) }}–{{ number_format($country->daily_budget_max) }}</b></div>
        <div><small>Capital</small><b>{{ $country->capital ?? '—' }}</b></div>
        <div><small>Currency</small><b>{{ $country->currency }}</b></div>
        <div><small>1 SAR buys</small><b>{{ $country->rate_from_sar ? rtrim(rtrim(number_format($country->rate_from_sar, $country->rate_from_sar < 10 ? 3 : 0), '0'), '.').' '.$country->currency : '—' }}</b></div>
        <div><small>Climate</small><b>{{ $country->climate }}</b></div>
        <div><small>Best time</small><b title="{{ $country->best_months }}">{{ $country->best_months ?? '—' }}</b></div>
    </div>

    <div class="section about-grid" id="about">
        <div>
            <p class="lead">{{ $country->description }}</p>
        </div>
        <aside class="panel">
            <div class="panel-body">
                <p class="small muted tight">A week here, roughly</p>
                <p class="week-cost"><x-price :amount="$country->daily_budget_min * 7" /> <span class="muted">to</span> <x-price :amount="$country->daily_budget_max * 7" /></p>
                <p class="small muted">Seven days at the daily budget above, per person, without flights.</p>
                @auth
                    <a class="btn btn-block" href="{{ route('destination.suggest') }}">Compare with other countries</a>
                @else
                    <a class="btn btn-block" href="{{ route('register') }}">Create a free account to plan</a>
                @endauth
            </div>
        </aside>
    </div>

    @if ($country->attractions->isNotEmpty())
        <section class="section" id="see">
            <div class="s-head"><div><h2>Things to do in {{ $country->name }}</h2><p>{{ $country->attractions->count() }} places we'd put on the list.</p></div></div>
            <div class="feature-list">
                @foreach ($country->attractions as $attraction)
                    <article class="feature">
                        <span class="no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <figure>
                            <div class="ph"><img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" loading="lazy"></div>
                            <figcaption><x-photo-credit :credit="$attraction->image_credit" /></figcaption>
                        </figure>
                        <div>
                            <h3>{{ $attraction->name }}</h3>
                            <div class="meta"><x-icon name="pin" size="sm" />{{ $attraction->city ?? $country->name }}<span class="badge">{{ $attraction->type }}</span></div>
                            <p>{{ $attraction->description }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if ($country->hotels->isNotEmpty())
        <section class="section" id="hotels">
            <div class="s-head"><div><h2>Where to stay</h2><p>Typical starting prices per night. Rates change with the season.</p></div>
                <div class="acts"><a class="all" href="{{ route('hotels.index', ['country' => $country->slug]) }}">All hotels in {{ $country->name }}</a></div>
            </div>
            <div class="grid cols-3">
                @foreach ($country->hotels as $hotel)
                    <div class="card">
                        <div class="ph"><img src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}" loading="lazy"></div>
                        <div class="body">
                            <h3 title="{{ $hotel->name }}">{{ $hotel->name }}</h3>
                            <div class="loc"><x-icon name="pin" size="sm" />{{ $hotel->city }}</div>
                            @if ($hotel->description)<p class="desc">{{ $hotel->description }}</p>@endif
                            <div class="foot">
                                <x-stars :count="$hotel->stars" />
                                <span class="amt"><small>from, per night</small><x-price :amount="$hotel->price_per_night" /></span>
                            </div>
                            <div class="card-credit"><x-photo-credit :credit="$hotel->image_credit" /></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($similar->isNotEmpty())
        <x-rail title="Similar budget" subtitle="Countries with a daily budget close to {{ $country->name }}." :href="route('explore')" link-text="All destinations">
            @foreach ($similar as $other)
                <x-dest-tile :country="$other" small />
            @endforeach
        </x-rail>
    @endif
</div>
@endsection
