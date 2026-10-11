@extends('layouts.admin')

@section('title', 'Add a place')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.attractions.index') }}">Things to do</a> / Add @endsection

@section('content')
<form method="POST" action="{{ route('admin.attractions.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="admin-title">
        <div><h1>Add a place</h1></div>
        <div class="row">
            <a class="btn btn-outline" href="{{ url()->previous() === url()->current() ? route('admin.attractions.index') : url()->previous() }}">Cancel</a>
            <button class="btn" type="submit">Save</button>
        </div>
    </div>
    @include('admin.attractions._form')
</form>
@endsection
