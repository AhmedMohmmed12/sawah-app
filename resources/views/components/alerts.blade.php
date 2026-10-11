@php
    $known = [
        'password-updated' => 'Your password has been changed.',
        'profile-updated' => 'Your details have been saved.',
        'verification-link-sent' => 'We sent a new verification link to your email address.',
    ];
@endphp
@foreach (['success' => 'success', 'status' => 'success', 'error' => 'error', 'info' => 'info'] as $key => $type)
    @if (session($key))
        <div class="alert alert-{{ $type }}" x-data="{ open: true }" x-show="open" role="status">
            <x-icon :name="$type === 'error' ? 'alert' : ($type === 'info' ? 'info' : 'check')" />
            <div>{{ $known[session($key)] ?? session($key) }}</div>
            <button type="button" class="alert-close" @click="open = false" aria-label="Dismiss"><x-icon name="x" size="sm" /></button>
        </div>
    @endif
@endforeach
