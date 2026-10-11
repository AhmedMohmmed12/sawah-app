@props(['hotel', 'showCountry' => true])
<a href="{{ route('country.show', $hotel->country->slug) }}#hotels" {{ $attributes->merge(['class' => 'card']) }}>
    <div class="ph">
        <img src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}" loading="lazy">
        @if ($showCountry)<span class="badge">{{ $hotel->country->name }}</span>@endif
    </div>
    <div class="body">
        <h3 title="{{ $hotel->name }}">{{ $hotel->name }}</h3>
        <div class="loc"><x-icon name="pin" size="sm" />{{ $hotel->city ?? $hotel->country->capital }}</div>
        <div class="foot">
            <x-stars :count="$hotel->stars" />
            <span class="amt"><small>from, per night</small><x-price :amount="$hotel->price_per_night" /></span>
        </div>
    </div>
</a>
