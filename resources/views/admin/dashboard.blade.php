@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="admin-title">
    <div>
        <h1>Overview</h1>
        <p>Exchange rates {{ $ratesUpdated ? 'updated '.$ratesUpdated->diffForHumans() : 'not fetched yet; run php artisan rates:update' }}.</p>
    </div>
    <div class="row">
        <a class="btn btn-outline" href="{{ route('home') }}" target="_blank">View site <x-icon name="external" size="sm" /></a>
        <a class="btn" href="{{ route('admin.countries.create') }}"><x-icon name="plus" size="sm" />Add country</a>
    </div>
</div>

<div class="stats">
    <div><small>Countries</small><b>{{ $stats['countries'] }}</b></div>
    <div><small>Hotels</small><b>{{ $stats['hotels'] }}</b></div>
    <div><small>Things to do</small><b>{{ $stats['attractions'] }}</b></div>
    <div><small>Registered travellers</small><b>{{ $stats['users'] }}</b></div>
</div>

<div class="admin-cols section">
    <div>
        <section class="panel">
            <div class="panel-head">
                <div><h2>Needs attention</h2><p>Countries missing a photo, capital, hotels or things to do.</p></div>
            </div>
            @if ($needsWork->isEmpty())
                <div class="panel-body muted">Everything is filled in.</div>
            @else
                <ul class="mini-list">
                    @foreach ($needsWork as $country)
                        <li>
                            <img src="{{ $country->image_url }}" alt="">
                            <div class="t">
                                <b>{{ $country->name }}</b>
                                <span>
                                    {{ collect([
                                        ! $country->image ? 'no photo' : null,
                                        ! $country->capital ? 'no capital' : null,
                                        $country->hotels_count === 0 ? 'no hotels' : null,
                                        $country->attractions_count < 2 ? $country->attractions_count.' things to do' : null,
                                    ])->filter()->join(', ') }}
                                </span>
                            </div>
                            <a class="btn btn-sm btn-outline" href="{{ route('admin.countries.show', $country) }}">Open</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <section class="panel">
            <div class="panel-head"><div><h2>Recently edited hotels</h2></div><a class="link small" href="{{ route('admin.hotels.index') }}">All hotels</a></div>
            <ul class="mini-list">
                @foreach ($recentHotels as $hotel)
                    <li>
                        <img src="{{ $hotel->image_url }}" alt="">
                        <div class="t"><b>{{ $hotel->name }}</b><span>{{ $hotel->city }}, {{ $hotel->country->name }} · {{ $hotel->updated_at->diffForHumans() }}</span></div>
                        <a class="btn btn-sm btn-ghost" href="{{ route('admin.hotels.edit', $hotel) }}"><x-icon name="pencil" size="sm" />Edit</a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>

    <div>
        <section class="panel">
            <div class="panel-head"><div><h2>Recently edited countries</h2></div></div>
            <ul class="mini-list">
                @foreach ($recentCountries as $country)
                    <li>
                        <img src="{{ $country->image_url }}" alt="">
                        <div class="t"><b>{{ $country->name }}</b><span>{{ $country->updated_at->diffForHumans() }}</span></div>
                        <a class="btn btn-sm btn-ghost" href="{{ route('admin.countries.edit', $country) }}"><x-icon name="pencil" size="sm" /></a>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="panel">
            <div class="panel-head"><div><h2>New travellers</h2></div></div>
            @if ($newUsers->isEmpty())
                <div class="panel-body muted">No sign-ups yet.</div>
            @else
                <ul class="mini-list">
                    @foreach ($newUsers as $user)
                        <li>
                            <span class="avatar">{{ Str::upper(Str::substr($user->name, 0, 1)) }}</span>
                            <div class="t"><b>{{ $user->name }}</b><span>Joined {{ $user->created_at->diffForHumans() }} · {{ $user->search_count }} {{ Str::plural('search', $user->search_count) }}</span></div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
</div>
@endsection
