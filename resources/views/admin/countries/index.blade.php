@extends('layouts.admin')

@section('title', 'Countries')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / Countries @endsection

@section('content')
<div class="admin-title">
    <div><h1>Countries</h1><p>{{ $countries->total() }} {{ Str::plural('country', $countries->total()) }} on the site.</p></div>
    <a class="btn" href="{{ route('admin.countries.create') }}"><x-icon name="plus" size="sm" />Add country</a>
</div>

<div class="panel">
    <form class="toolbar" method="GET">
        <input class="input" type="search" name="q" value="{{ $search }}" placeholder="Search name, capital or currency">
        <button class="btn btn-sm btn-dark" type="submit">Search</button>
        @if ($search)<a class="btn btn-sm btn-ghost" href="{{ route('admin.countries.index') }}">Clear</a>@endif
    </form>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Country</th><th>Region</th><th>Climate</th><th class="num">SAR / day</th><th class="num">1 unit in SAR</th><th class="num">Hotels</th><th class="num">To do</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($countries as $country)
                    <tr>
                        <td>
                            <a class="name" href="{{ route('admin.countries.show', $country) }}">
                                <img class="thumb" src="{{ $country->image_url }}" alt="">
                                <span>{{ $country->name }}<small>{{ $country->capital }} · {{ $country->code }}</small></span>
                            </a>
                        </td>
                        <td>{{ $country->region ?? '—' }}</td>
                        <td>{{ $country->climate }}</td>
                        <td class="num">{{ number_format($country->daily_budget_min) }}–{{ number_format($country->daily_budget_max) }}</td>
                        <td class="num">{{ $country->currency }} {{ rtrim(rtrim(number_format($country->exchange_rate_to_sar, 5), '0'), '.') }}</td>
                        <td class="num">{{ $country->hotels_count }}</td>
                        <td class="num">{{ $country->attractions_count }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-sm btn-ghost" href="{{ route('country.show', $country->slug) }}" target="_blank" title="View on site"><x-icon name="eye" size="sm" /></a>
                                <a class="btn btn-sm btn-outline" href="{{ route('admin.countries.edit', $country) }}"><x-icon name="pencil" size="sm" />Edit</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8"><div class="empty"><h3>No countries found</h3><p>Try a different search.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $countries->links() }}
@endsection
