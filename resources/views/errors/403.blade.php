@extends('layouts.app')

@section('title', 'Not allowed | Sawah')

@section('content')
<div class="wrap-narrow">
    <div class="empty">
        <p class="mono small">403</p>
        <h3>You can't open this page</h3>
        <p>{{ $exception->getMessage() && $exception->getMessage() !== 'Unauthorized access.' ? $exception->getMessage() : 'Your account doesn\'t have access to this part of Sawah.' }}</p>
        <a class="btn btn-outline" href="{{ route('home') }}">Go to the home page</a>
    </div>
</div>
@endsection
