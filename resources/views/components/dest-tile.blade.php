@props(['country', 'small' => false])
<a href="{{ route('country.show', $country->slug) }}" {{ $attributes->merge(['class' => 'dest'.($small ? ' dest-sm' : '')]) }}>
    <img src="{{ $country->image_url }}" alt="{{ $country->image_caption ?? $country->name }}" loading="lazy">
    <span class="tag"><small>Daily budget from</small><i>SAR</i><b>{{ number_format($country->daily_budget_min) }}</b></span>
    <span class="cap"><b>{{ $country->name }}</b><span>{{ $country->climate }} · {{ $country->currency }}</span></span>
</a>
