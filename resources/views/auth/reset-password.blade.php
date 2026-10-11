<x-guest-layout>
    <x-slot:title>Choose a new password</x-slot:title>

    <h1>Choose a new password</h1>
    <p class="sub">Use at least 8 characters.</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autocomplete="username">
            @error('email')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label class="label" for="password">New password</label>
            <input class="input @error('password') is-invalid @enderror" id="password" type="password" name="password" required autofocus autocomplete="new-password">
            @error('password')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label class="label" for="password_confirmation">Repeat new password</label>
            <input class="input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')<p class="error">{{ $message }}</p>@enderror
        </div>
        <button class="btn btn-block btn-lg" type="submit">Save password</button>
    </form>
</x-guest-layout>
