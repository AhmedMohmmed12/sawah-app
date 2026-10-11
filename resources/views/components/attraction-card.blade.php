@props(['attraction'])
<a href="{{ route('country.show', $attraction->country->slug) }}#see" {{ $attributes->merge(['class' => 'att']) }}>
    <div class="ph"><img src="{{ $attraction->image_url }}" alt="{{ $attraction->name }}" loading="lazy"></div>
    <div>
        <b title="{{ $attraction->name }}">{{ $attraction->name }}</b>
        <span class="loc">{{ collect([$attraction->city, $attraction->country->name])->filter()->unique()->join(', ') }}</span>
        <span class="badge">{{ $attraction->type }}</span>
    </div>
</a>
