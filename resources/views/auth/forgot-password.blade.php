<x-guest-layout>
    <x-slot:title>Reset password</x-slot:title>

    <h1>Forgot your password?</h1>
    <p class="sub">Enter the email you signed up with and we'll send you a link to choose a new one.</p>

    <x-alerts />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')<p class="error">{{ $message }}</p>@enderror
        </div>
        <button class="btn btn-block btn-lg" type="submit">Send reset link</button>
    </form>

    <p class="alt"><a class="link" href="{{ route('login') }}">Back to sign in</a></p>
</x-guest-layout>
