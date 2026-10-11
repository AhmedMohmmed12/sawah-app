@extends('layouts.admin')

@section('title', 'Add hotel')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / <a href="{{ route('admin.hotels.index') }}">Hotels</a> / Add @endsection

@section('content')
<form method="POST" action="{{ route('admin.hotels.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="admin-title">
        <div><h1>Add a hotel</h1></div>
        <div class="row">
            <a class="btn btn-outline" href="{{ url()->previous() === url()->current() ? route('admin.hotels.index') : url()->previous() }}">Cancel</a>
            <button class="btn" type="submit">Save hotel</button>
        </div>
    </div>
    @include('admin.hotels._form')
</form>
@endsection
