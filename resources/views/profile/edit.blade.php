@extends('layouts.app')

@section('title', 'Account settings | Sawah')

@section('content')
<div class="wrap account">
    @include('layouts.partials.account-nav')

    <div>
        <div class="greeting">
            <h1>Account settings</h1>
            <p>Your details, travel preferences and password.</p>
        </div>

        <div class="section">
            <x-alerts />

            @include('profile.partials.details', ['action' => route('profile.update')])

            <section class="panel" id="preferences">
                <div class="panel-head"><div><h2>Travel preferences</h2><p>Used to fill in the trip planner and suggest countries on your dashboard.</p></div></div>
                <form class="panel-body" method="POST" action="{{ route('profile.travel-preferences') }}">
                    @csrf
                    @method('patch')
                    <div class="form-grid">
                        <div class="field">
                            <label class="label" for="budget_range">Usual daily budget</label>
                            <select class="select @error('budget_range') is-invalid @enderror" id="budget_range" name="budget_range">
                                <option value="">No preference</option>
                                @foreach (App\Models\User::BUDGET_RANGES as $key => [, , $label])
                                    <option value="{{ $key }}" @selected(old('budget_range', $user->budget_range) === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <p class="help">Per person, without flights.</p>
                            @error('budget_range')<p class="error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label class="label" for="preferred_climate">Weather</label>
                            <select class="select @error('preferred_climate') is-invalid @enderror" id="preferred_climate" name="preferred_climate">
                                @foreach (['no_preference' => 'No preference', 'warm' => 'Warm', 'mild' => 'Mild', 'cold' => 'Cold'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('preferred_climate', $user->preferred_climate ?? 'no_preference') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('preferred_climate')<p class="error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field full">
                            <span class="label">Interests</span>
                            <div class="checks">
                                @foreach (App\Models\User::INTERESTS as $value => $label)
                                    <label class="chip">
                                        <input type="checkbox" name="interests[]" value="{{ $value }}" @checked(in_array($value, old('interests', $user->travel_interests ?? [])))>
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('interests.*')<p class="error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <button class="btn" type="submit">Save preferences</button>
                </form>
            </section>

            @include('profile.partials.password')
            @include('profile.partials.delete', ['action' => route('profile.destroy')])
        </div>
    </div>
</div>
@endsection
