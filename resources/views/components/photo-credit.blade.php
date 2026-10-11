@props(['credit' => null, 'caption' => null])
@if ($credit || $caption)
    <span {{ $attributes->merge(['class' => 'credit-line']) }}>{{ collect([$caption, $credit ? 'Photo: '.$credit : null])->filter()->join(' · ') }}</span>
@endif
