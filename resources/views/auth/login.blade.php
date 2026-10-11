<x-guest-layout>
    <x-slot:title>Sign in</x-slot:title>

    <h1>Welcome back</h1>
    <p class="sub">Sign in to use the trip planner and see your saved preferences.</p>

    <x-alerts />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <div class="spread">
                <label class="label" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a class="link small" href="{{ route('password.request') }}">Forgot it?</a>
                @endif
            </div>
            <input class="input @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label class="check"><input type="checkbox" name="remember" id="remember_me">Keep me signed in</label>
        </div>
        <button class="btn btn-block btn-lg" type="submit">Sign in</button>
    </form>

    <p class="alt">New to Sawah? <a class="link" href="{{ route('register') }}">Create a free account</a></p>
</x-guest-layout>
