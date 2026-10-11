@extends('layouts.app')

@section('title', 'Trip planner | Sawah')

@section('content')
<div class="page-head">
    <div class="wrap">
        <div class="crumbs"><a href="{{ route('home') }}">Home</a><span>/</span><span>Trip planner</span></div>
        <h1>Trip planner</h1>
        <p>Set a daily budget, the weather you want and the kind of trip. We'll show the countries that fit and explain why.</p>
    </div>
</div>

<div class="wrap">
    <div class="section">
        <x-alerts />
        @if ($errors->any())
            <div class="alert alert-error"><x-icon name="alert" /><div>Please check the form: {{ $errors->first() }}</div></div>
        @endif

        <x-search-card :values="$search" />
    </div>

    <section class="section">
        <div class="s-head"><div><h2>How the matching works</h2></div></div>
        <div class="grid cols-3">
            <div class="panel"><div class="panel-body">
                <p class="mono small muted tight">01 · Budget</p>
                <p>A country fits if its daily range overlaps yours. The budget covers a mid-range hotel, food, local transport and entry fees for one person, not flights.</p>
            </div></div>
            <div class="panel"><div class="panel-body">
                <p class="mono small muted tight">02 · Weather</p>
                <p>Each country is marked warm, mild or cold for its main travel season. Pick "Any weather" to skip this.</p>
            </div></div>
            <div class="panel"><div class="panel-body">
                <p class="mono small muted tight">03 · Trip type</p>
                <p>Countries with more things to do of the right kind rank higher, for example beaches and nature for a relaxing trip.</p>
            </div></div>
        </div>
        @if (! Auth::user()->budget_range && ! Auth::user()->preferred_climate)
            <p class="muted section-note">Tip: save your usual budget and weather in <a class="link" href="{{ route('profile.edit') }}#preferences">account settings</a> and this form will be filled in for you.</p>
        @endif
    </section>
</div>
@endsection
