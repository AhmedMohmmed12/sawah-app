@props(['amount', 'currency' => 'SAR'])
<span {{ $attributes->merge(['class' => 'price']) }}><span class="cur">{{ $currency }}</span>{{ number_format((float) $amount) }}</span>
