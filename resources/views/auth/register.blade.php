<x-guest-layout>
    <x-slot:title>Create account</x-slot:title>

    <h1>Create your account</h1>
    <p class="sub">Free. You'll be able to use the trip planner and save how you like to travel.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <label class="label" for="name">Name</label>
            <input class="input @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label class="label" for="password">Password</label>
            <input class="input @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password">
            <p class="help">At least 8 characters.</p>
            @error('password')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label class="label" for="password_confirmation">Repeat password</label>
            <input class="input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button class="btn btn-block btn-lg" type="submit">Create account</button>
    </form>

    <p class="alt">Already have an account? <a class="link" href="{{ route('login') }}">Sign in</a></p>
</x-guest-layout>
