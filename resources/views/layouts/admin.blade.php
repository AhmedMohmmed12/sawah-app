<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Admin') | Sawah admin</title>
    @include('layouts.partials.head')
</head>
<body>
<div class="admin" x-data="{ nav: false }">
    <aside class="admin-side" :class="{ 'is-open': nav }" @click.outside="nav = false">
        <a class="logo" href="{{ route('admin.dashboard') }}">sawah<span class="ar" lang="ar">سوّاح</span></a>
        <div class="tagline">admin</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}"><x-icon name="dashboard" />Overview</a>
            <span class="group">Content</span>
            <a href="{{ route('admin.countries.index') }}" class="{{ request()->routeIs('admin.countries.*') ? 'is-active' : '' }}"><x-icon name="globe" />Countries</a>
            <a href="{{ route('admin.hotels.index') }}" class="{{ request()->routeIs('admin.hotels.*') ? 'is-active' : '' }}"><x-icon name="bed" />Hotels</a>
            <a href="{{ route('admin.attractions.index') }}" class="{{ request()->routeIs('admin.attractions.*') ? 'is-active' : '' }}"><x-icon name="ticket" />Things to do</a>
            <span class="group">Account</span>
            <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'is-active' : '' }}"><x-icon name="settings" />Settings</a>
        </nav>
        <div class="bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><x-icon name="logout" />Sign out</button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-top">
            <div class="row">
                <button class="admin-burger" type="button" @click.stop="nav = !nav" aria-label="Menu"><x-icon name="menu" /></button>
                <div class="crumbs">@yield('crumbs', 'Overview')</div>
            </div>
            <div class="me"><span class="avatar">{{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}</span><span class="hide-sm">{{ Auth::user()->name }}</span></div>
        </header>

        <div class="admin-body">
            <x-alerts />
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
