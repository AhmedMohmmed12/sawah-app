@php
    $photo = \App\Models\Country::whereNotNull('image_credit')->inRandomOrder()->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sign in' }} | Sawah</title>
    @include('layouts.partials.head')
</head>
<body>
    <div class="auth">
        <aside class="auth-photo" @if ($photo) style="background-image: url('{{ $photo->image_url }}')" @endif>
            <a class="logo" href="{{ route('home') }}">sawah<span class="ar" lang="ar">سوّاح</span></a>
            <div>
                <blockquote>Tell us what you can spend a day. We'll show you where to go.</blockquote>
                @if ($photo)
                    <p class="credit">{{ $photo->image_caption }}, {{ $photo->name }} · Photo: {{ $photo->image_credit }}</p>
                @endif
            </div>
        </aside>

        <main class="auth-main">
            <div class="auth-box">
                <a class="logo auth-mobile-logo" href="{{ route('home') }}">sawah<span class="ar" lang="ar">سوّاح</span></a>
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
