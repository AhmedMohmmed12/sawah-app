@extends('layouts.admin')

@section('title', 'Edit '.$hotel->name)
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.hotels.index') }}">Hotels</a> / {{ $hotel->name }} @endsection

@section('content')
<form method="POST" action="{{ route('admin.hotels.update', $hotel) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="admin-title">
        <div><h1>{{ $hotel->name }}</h1><p>{{ $hotel->city }}, {{ $hotel->country->name }} · last changed {{ $hotel->updated_at->diffForHumans() }}</p></div>
        <div class="row">
            <a class="btn btn-outline" href="{{ route('admin.hotels.index') }}">Cancel</a>
            <button class="btn" type="submit">Save changes</button>
        </div>
    </div>
    @include('admin.hotels._form')
</form>

<section class="panel panel-danger section">
    <div class="panel-head">
        <div><h2>Delete hotel</h2><p>Removes it from {{ $hotel->country->name }}.</p></div>
        <x-delete-button :action="route('admin.hotels.destroy', $hotel)" :name="$hotel->name" label="Delete hotel" />
    </div>
</section>
@endsection
