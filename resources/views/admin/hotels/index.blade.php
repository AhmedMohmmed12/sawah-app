@extends('layouts.admin')

@section('title', 'Hotels')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / Hotels @endsection

@section('content')
<div class="admin-title">
    <div><h1>Hotels</h1><p>{{ $hotels->total() }} {{ Str::plural('hotel', $hotels->total()) }}{{ $search || $countryId ? ' match' : ' in total' }}.</p></div>
    <a class="btn" href="{{ route('admin.hotels.create', ['country' => $countryId]) }}"><x-icon name="plus" size="sm" />Add hotel</a>
</div>

<div class="panel">
    <form class="toolbar" method="GET">
        <input class="input" type="search" name="q" value="{{ $search }}" placeholder="Search name or city">
        <select class="select" name="country">
            <option value="">All countries</option>
            @foreach ($countries as $c)
                <option value="{{ $c->id }}" @selected($countryId === $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-dark" type="submit">Filter</button>
        @if ($search || $countryId)<a class="btn btn-sm btn-ghost" href="{{ route('admin.hotels.index') }}">Clear</a>@endif
    </form>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Hotel</th><th>Country</th><th>Stars</th><th class="num">From / night</th><th></th></tr></thead>
            <tbody>
                @forelse ($hotels as $hotel)
                    <tr>
                        <td><a class="name" href="{{ route('admin.hotels.edit', $hotel) }}"><img class="thumb" src="{{ $hotel->image_url }}" alt=""><span>{{ $hotel->name }}<small>{{ $hotel->city }}</small></span></a></td>
                        <td>{{ $hotel->country->name }}</td>
                        <td><x-stars :count="$hotel->stars" /></td>
                        <td class="num">SAR {{ number_format($hotel->price_per_night) }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-sm btn-outline" href="{{ route('admin.hotels.edit', $hotel) }}"><x-icon name="pencil" size="sm" />Edit</a>
                                <x-delete-button :action="route('admin.hotels.destroy', $hotel)" :name="$hotel->name" label="" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="empty"><h3>No hotels found</h3><p>Try a different search or country.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $hotels->links() }}
@endsection
