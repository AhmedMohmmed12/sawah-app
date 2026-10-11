<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sawah: find where your budget takes you')</title>
    <meta name="description" content="@yield('description', 'Compare 22 countries by daily budget in riyals, weather and trip type, with hotels and things to do in each.')">
    @include('layouts.partials.head')
</head>
<body>
    <header class="site-header">
        <div class="wrap">
            <div class="bar">
                <a class="logo" href="{{ route('home') }}" aria-label="Sawah home">sawah<span class="ar" lang="ar">سوّاح</span></a>

                <div class="bar-right">
                    <span class="cur hide-sm" title="All prices are shown in Saudi riyals">SAR</span>
                    @auth
                        <div class="menu" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
                            <button type="button" class="menu-button" @click="open = !open" :aria-expanded="open">
                                <span class="avatar">{{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}</span>
                                <span class="name">{{ Str::before(Auth::user()->name, ' ') }}</span>
                                <x-icon name="chevron-down" size="sm" />
                            </button>
                            <div class="menu-panel" x-show="open" x-cloak x-transition.opacity.duration.100ms>
                                <div class="who"><b>{{ Auth::user()->name }}</b><span>{{ Auth::user()->email }}</span></div>
                                @if (Auth::user()->hasRole('manager'))
                                    <a href="{{ route('admin.dashboard') }}"><x-icon name="dashboard" />Admin panel</a>
                                @else
                                    <a href="{{ route('dashboard') }}"><x-icon name="dashboard" />My trips</a>
                                    <a href="{{ route('profile.edit') }}"><x-icon name="settings" />Account settings</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"><x-icon name="logout" />Sign out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="hide-sm">Create account</a>
                        <a href="{{ route('login') }}" class="btn-pill-outline">Sign in</a>
                    @endauth
                </div>
            </div>

            <nav class="tabs" aria-label="Sections">
                <a class="tab {{ request()->routeIs('explore', 'country.show') ? 'is-active' : '' }}" href="{{ route('explore') }}"><x-icon name="globe" />Destinations</a>
                <a class="tab {{ request()->routeIs('hotels.index') ? 'is-active' : '' }}" href="{{ route('hotels.index') }}"><x-icon name="bed" />Hotels</a>
                <a class="tab {{ request()->routeIs('attractions.index') ? 'is-active' : '' }}" href="{{ route('attractions.index') }}"><x-icon name="ticket" />Things to do</a>
                <a class="tab {{ request()->routeIs('destination.*') ? 'is-active' : '' }}" href="{{ route('destination.suggest') }}"><x-icon name="compass" />Trip planner</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap">
            <div class="cols">
                <div>
                    <a class="logo" href="{{ route('home') }}">sawah<span class="ar" lang="ar">سوّاح</span></a>
                    <p class="about">A small trip planner that matches your daily budget in riyals to countries, hotels and things to do.</p>
                </div>
                <div>
                    <h4>Explore</h4>
                    <a href="{{ route('explore') }}">Destinations</a>
                    <a href="{{ route('hotels.index') }}">Hotels</a>
                    <a href="{{ route('attractions.index') }}">Things to do</a>
                    <a href="{{ route('destination.suggest') }}">Trip planner</a>
                </div>
                <div>
                    <h4>Account</h4>
                    @auth
                        <a href="{{ route('dashboard') }}">My trips</a>
                        <a href="{{ route('profile.edit') }}">Account settings</a>
                    @else
                        <a href="{{ route('login') }}">Sign in</a>
                        <a href="{{ route('register') }}">Create account</a>
                    @endauth
                </div>
                <div>
                    <h4>About</h4>
                    <a href="{{ route('credits') }}">Photo credits</a>
                    <a href="https://open.er-api.com" rel="noopener" target="_blank">Exchange rate source</a>
                </div>
            </div>
            <div class="base">
                <span>© {{ date('Y') }} Sawah</span>
                <span>Prices are estimates in SAR. Check with the hotel before you book.</span>
            </div>
        </div>
    </footer>
</body>
</html>
