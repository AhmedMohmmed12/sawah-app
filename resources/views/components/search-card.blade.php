@props(['values' => []])
@php
    $tripTypes = ['Cultural', 'Adventure', 'Relaxation', 'Family', 'Business'];
    $trip = $values['trip_type'] ?? 'Cultural';
    $min = $values['budget_min'] ?? 300;
    $max = $values['budget_max'] ?? 800;
    $weather = $values['weather'] ?? 'No preference';
@endphp
<form method="GET" action="{{ route('destination.find') }}" {{ $attributes->merge(['class' => 'search-card']) }}>
    <div class="chips" role="radiogroup" aria-label="Trip type">
        <span class="lbl">Trip type</span>
        @foreach ($tripTypes as $type)
            <label class="chip">
                <input type="radio" name="trip_type" value="{{ $type }}" @checked($trip === $type)>
                <span>{{ $type }}</span>
            </label>
        @endforeach
    </div>
    <div class="search-fields">
        <label class="sf">
            <x-icon name="wallet" />
            <div><small>Min. budget per day</small><span class="in"><span class="unit">SAR</span><input type="number" name="budget_min" min="0" step="50" value="{{ $min }}" inputmode="numeric"></span></div>
        </label>
        <label class="sf">
            <x-icon name="wallet" />
            <div><small>Max. budget per day</small><span class="in"><span class="unit">SAR</span><input type="number" name="budget_max" min="0" step="50" value="{{ $max }}" inputmode="numeric"></span></div>
        </label>
        <label class="sf">
            <x-icon name="sun" />
            <div><small>Weather</small>
                <select name="weather">
                    @foreach (['No preference' => 'Any weather', 'Warm' => 'Warm', 'Mild' => 'Mild', 'Cold' => 'Cold'] as $value => $label)
                        <option value="{{ $value }}" @selected($weather === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </label>
        <button class="search-go" type="submit"><x-icon name="search" />Search</button>
    </div>
    @guest
        <p class="search-note">You'll be asked to sign in or create a free account to see results.</p>
    @endguest
</form>
