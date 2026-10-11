@extends('layouts.app')

@section('title', 'My trips | Sawah')

@section('content')
<div class="wrap account">
    @include('layouts.partials.account-nav')

    <div>
        <x-alerts />

        <div class="greeting">
            <h1>Hello, {{ Str::before($user->name, ' ') }}</h1>
            <p>
                Member since {{ $user->created_at->format('F Y') }}
                · {{ $user->search_count }} {{ Str::plural('search', $user->search_count) }} in the trip planner
            </p>
        </div>

        <div class="section">
            <x-search-card :values="$search" />
        </div>

        <section class="section">
            @if ($hasPreferences)
                <div class="s-head">
                    <div>
                        <h2>Picked for you</h2>
                        <p>Based on your saved preferences.</p>
                        <div class="prefs-summary">
                            @if ($user->budget_range && isset(App\Models\User::BUDGET_RANGES[$user->budget_range]))
                                <span class="badge badge-warm">{{ App\Models\User::BUDGET_RANGES[$user->budget_range][2] }}</span>
                            @endif
                            @if ($user->preferred_climate && $user->preferred_climate !== 'no_preference')
                                <span class="badge badge-warm">{{ ucfirst($user->preferred_climate) }} weather</span>
                            @endif
                            @foreach ($user->travel_interests ?? [] as $interest)
                                <span class="badge badge-warm">{{ App\Models\User::INTERESTS[$interest] ?? ucfirst($interest) }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="acts"><a class="all" href="{{ route('profile.edit') }}#preferences">Change preferences</a></div>
                </div>

                @if ($picks->isEmpty())
                    <div class="panel"><div class="empty">
                        <h3>Nothing matches yet</h3>
                        <p>No country fits both your budget and your weather. Try widening one of them.</p>
                        <a class="btn btn-outline" href="{{ route('profile.edit') }}#preferences">Edit preferences</a>
                    </div></div>
                @else
                    <div class="grid">
                        @foreach ($picks as $country)
                            <x-dest-tile :country="$country" small />
                        @endforeach
                    </div>
                @endif
            @else
                <div class="panel"><div class="empty">
                    <h3>Tell us how you like to travel</h3>
                    <p>Save a usual budget, the weather you like and your interests, and we'll suggest countries here and fill in the trip planner for you.</p>
                    <a class="btn" href="{{ route('profile.edit') }}#preferences">Set preferences</a>
                </div></div>
            @endif
        </section>
    </div>
</div>
@endsection
