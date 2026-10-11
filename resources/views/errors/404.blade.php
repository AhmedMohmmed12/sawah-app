@extends('layouts.app')

@section('title', 'Page not found | Sawah')

@section('content')
<div class="wrap-narrow">
    <div class="empty">
        <p class="mono small">404</p>
        <h3>We couldn't find that page</h3>
        <p>It may have moved, or the link might be wrong.</p>
        <a class="btn btn-outline" href="{{ route('explore') }}">Browse destinations</a>
    </div>
</div>
@endsection
