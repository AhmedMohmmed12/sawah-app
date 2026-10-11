@extends('layouts.admin')

@section('title', 'Edit '.$attraction->name)
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.attractions.index') }}">Things to do</a> / {{ $attraction->name }} @endsection

@section('content')
<form method="POST" action="{{ route('admin.attractions.update', $attraction) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="admin-title">
        <div><h1>{{ $attraction->name }}</h1><p>{{ collect([$attraction->city, $attraction->country->name])->filter()->join(', ') }} · last changed {{ $attraction->updated_at->diffForHumans() }}</p></div>
        <div class="row">
            <a class="btn btn-outline" href="{{ route('admin.attractions.index') }}">Cancel</a>
            <button class="btn" type="submit">Save changes</button>
        </div>
    </div>
    @include('admin.attractions._form')
</form>

<section class="panel panel-danger section">
    <div class="panel-head">
        <div><h2>Delete</h2><p>Removes it from {{ $attraction->country->name }}.</p></div>
        <x-delete-button :action="route('admin.attractions.destroy', $attraction)" :name="$attraction->name" label="Delete" />
    </div>
</section>
@endsection
