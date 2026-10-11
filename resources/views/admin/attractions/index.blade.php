@extends('layouts.admin')

@section('title', 'Things to do')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / Things to do @endsection

@section('content')
<div class="admin-title">
    <div><h1>Things to do</h1><p>{{ $attractions->total() }} {{ Str::plural('place', $attractions->total()) }}{{ $search || $countryId || $type ? ' match' : ' in total' }}.</p></div>
    <a class="btn" href="{{ route('admin.attractions.create', ['country' => $countryId]) }}"><x-icon name="plus" size="sm" />Add place</a>
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
        <select class="select" name="type">
            <option value="">All types</option>
            @foreach (App\Models\Attraction::TYPES as $t)
                <option value="{{ $t }}" @selected($type === $t)>{{ $t }}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-dark" type="submit">Filter</button>
        @if ($search || $countryId || $type)<a class="btn btn-sm btn-ghost" href="{{ route('admin.attractions.index') }}">Clear</a>@endif
    </form>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Name</th><th>Country</th><th>Type</th><th></th></tr></thead>
            <tbody>
                @forelse ($attractions as $attraction)
                    <tr>
                        <td><a class="name" href="{{ route('admin.attractions.edit', $attraction) }}"><img class="thumb" src="{{ $attraction->image_url }}" alt=""><span>{{ $attraction->name }}<small>{{ $attraction->city }}</small></span></a></td>
                        <td>{{ $attraction->country->name }}</td>
                        <td><span class="badge">{{ $attraction->type }}</span></td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-sm btn-outline" href="{{ route('admin.attractions.edit', $attraction) }}"><x-icon name="pencil" size="sm" />Edit</a>
                                <x-delete-button :action="route('admin.attractions.destroy', $attraction)" :name="$attraction->name" label="" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><div class="empty"><h3>Nothing found</h3><p>Try a different search or filter.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $attractions->links() }}
@endsection
