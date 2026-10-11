@extends('layouts.admin')

@section('title', 'Edit '.$country->name)
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.countries.index') }}">Countries</a> / <a href="{{ route('admin.countries.show', $country) }}">{{ $country->name }}</a> / Edit @endsection

@section('content')
<form method="POST" action="{{ route('admin.countries.update', $country) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="admin-title">
        <div><h1>Edit {{ $country->name }}</h1><p>Last changed {{ $country->updated_at->diffForHumans() }}.</p></div>
        <div class="row">
            <a class="btn btn-outline" href="{{ route('admin.countries.show', $country) }}">Cancel</a>
            <button class="btn" type="submit">Save changes</button>
        </div>
    </div>
    @include('admin.countries._form')
</form>

<section class="panel panel-danger section">
    <div class="panel-head">
        <div><h2>Delete country</h2><p>Also deletes its {{ $country->hotels()->count() }} hotels and {{ $country->attractions()->count() }} things to do.</p></div>
        <x-delete-button :action="route('admin.countries.destroy', $country)" :name="$country->name" note="Its hotels and things to do will be deleted too. This can't be undone." label="Delete country" />
    </div>
</section>
@endsection
