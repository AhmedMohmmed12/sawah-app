@extends('layouts.admin')

@section('title', 'Add country')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.countries.index') }}">Countries</a> / Add @endsection

@section('content')
<form method="POST" action="{{ route('admin.countries.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="admin-title">
        <div><h1>Add a country</h1><p>Hotels and things to do can be added once it's saved.</p></div>
        <div class="row">
            <a class="btn btn-outline" href="{{ route('admin.countries.index') }}">Cancel</a>
            <button class="btn" type="submit">Save country</button>
        </div>
    </div>
    @include('admin.countries._form')
</form>
@endsection
