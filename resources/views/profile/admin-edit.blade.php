@extends('layouts.admin')

@section('title', 'Settings')
@section('crumbs')<a href="{{ route('admin.dashboard') }}">Overview</a> / Settings @endsection

@section('content')
<div class="admin-title">
    <div><h1>Settings</h1><p>Manager account since {{ $user->created_at->format('F Y') }}.</p></div>
</div>

<div class="wrap-narrow admin-settings">
    @include('profile.partials.details', ['action' => route('admin.profile.update')])
    @include('profile.partials.password')
    @include('profile.partials.delete', ['action' => route('admin.profile.destroy')])
</div>
@endsection
