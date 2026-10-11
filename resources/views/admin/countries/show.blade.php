@extends('layouts.admin')

@section('title', $country->name)
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.countries.index') }}">Countries</a> / {{ $country->name }} @endsection

@section('content')
<div class="admin-title">
    <div><h1>{{ $country->name }}</h1><p>{{ collect([$country->capital, $country->region, $country->climate.' climate'])->filter()->join(' · ') }}</p></div>
    <div class="row">
        <a class="btn btn-outline" href="{{ route('country.show', $country->slug) }}" target="_blank">View on site <x-icon name="external" size="sm" /></a>
        <a class="btn" href="{{ route('admin.countries.edit', $country) }}"><x-icon name="pencil" size="sm" />Edit</a>
    </div>
</div>

<div class="admin-cols">
    <section class="panel">
        <div class="panel-body">
            <dl class="dl">
                <dt>Daily budget</dt><dd class="mono">SAR {{ number_format($country->daily_budget_min) }}–{{ number_format($country->daily_budget_max) }}</dd>
                <dt>Currency</dt><dd class="mono">{{ $country->currency }} · 1 = SAR {{ rtrim(rtrim(number_format($country->exchange_rate_to_sar, 5), '0'), '.') }}</dd>
                <dt>Best time</dt><dd>{{ $country->best_months ?? '—' }}</dd>
                <dt>Code / URL</dt><dd class="mono">{{ $country->code }} · /destinations/{{ $country->slug }}</dd>
                <dt>Description</dt><dd class="muted plain">{{ $country->description }}</dd>
            </dl>
        </div>
    </section>
    <section class="panel">
        <img class="form-photo" src="{{ $country->image_url }}" alt="">
        <div class="panel-body"><x-photo-credit :caption="$country->image_caption" :credit="$country->image_credit" /></div>
    </section>
</div>

<section class="panel section">
    <div class="panel-head">
        <div><h2>Hotels</h2><p>{{ $country->hotels->count() }} listed</p></div>
        <a class="btn btn-sm" href="{{ route('admin.hotels.create', ['country' => $country->id]) }}"><x-icon name="plus" size="sm" />Add hotel</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Hotel</th><th>Stars</th><th class="num">From / night</th><th></th></tr></thead>
            <tbody>
                @forelse ($country->hotels as $hotel)
                    <tr>
                        <td><span class="name"><img class="thumb" src="{{ $hotel->image_url }}" alt=""><span>{{ $hotel->name }}<small>{{ $hotel->city }}</small></span></span></td>
                        <td><x-stars :count="$hotel->stars" /></td>
                        <td class="num">SAR {{ number_format($hotel->price_per_night) }}</td>
                        <td><div class="actions"><a class="btn btn-sm btn-outline" href="{{ route('admin.hotels.edit', $hotel) }}">Edit</a></div></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="muted">No hotels yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="panel section">
    <div class="panel-head">
        <div><h2>Things to do</h2><p>{{ $country->attractions->count() }} listed</p></div>
        <a class="btn btn-sm" href="{{ route('admin.attractions.create', ['country' => $country->id]) }}"><x-icon name="plus" size="sm" />Add</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Name</th><th>Type</th><th></th></tr></thead>
            <tbody>
                @forelse ($country->attractions as $attraction)
                    <tr>
                        <td><span class="name"><img class="thumb" src="{{ $attraction->image_url }}" alt=""><span>{{ $attraction->name }}<small>{{ $attraction->city }}</small></span></span></td>
                        <td><span class="badge">{{ $attraction->type }}</span></td>
                        <td><div class="actions"><a class="btn btn-sm btn-outline" href="{{ route('admin.attractions.edit', $attraction) }}">Edit</a></div></td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">Nothing listed yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
