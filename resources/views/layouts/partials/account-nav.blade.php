<nav class="side-nav" aria-label="Account">
    <div class="who">
        <span class="avatar">{{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}</span>
        <div><b>{{ Auth::user()->name }}</b><span>{{ Auth::user()->email }}</span></div>
    </div>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'is-active' : '' }}"><x-icon name="dashboard" />My trips</a>
    <a href="{{ route('destination.suggest') }}"><x-icon name="compass" />Trip planner</a>
    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'is-active' : '' }}"><x-icon name="settings" />Account settings</a>
</nav>
