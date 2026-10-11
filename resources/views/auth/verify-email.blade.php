<x-guest-layout>
    <x-slot:title>Verify your email</x-slot:title>

    <h1>Check your inbox</h1>
    <p class="sub">We sent a verification link to your email address. Click it to finish setting up your account.</p>

    <x-alerts />

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn btn-block btn-lg" type="submit">Send the link again</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="alt">
        @csrf
        <button class="link-button" type="submit">Sign out</button>
    </form>
</x-guest-layout>
