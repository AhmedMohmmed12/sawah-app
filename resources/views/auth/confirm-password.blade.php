<x-guest-layout>
    <x-slot:title>Confirm password</x-slot:title>

    <h1>Confirm your password</h1>
    <p class="sub">This is a protected part of your account. Please enter your password to continue.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="field">
            <label class="label" for="password">Password</label>
            <input class="input @error('password') is-invalid @enderror" id="password" type="password" name="password" required autofocus autocomplete="current-password">
            @error('password')<p class="error">{{ $message }}</p>@enderror
        </div>
        <button class="btn btn-block btn-lg" type="submit">Continue</button>
    </form>
</x-guest-layout>
