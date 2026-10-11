@extends('layouts.app')

@section('title', 'Photo credits | Sawah')

@section('content')
<div class="page-head">
    <div class="wrap">
        <div class="crumbs"><a href="{{ route('home') }}">Home</a><span>/</span><span>Photo credits</span></div>
        <h1>Photo credits</h1>
        <p>Every photo on Sawah comes from Wikimedia Commons and is used under the licence shown. Thank you to the photographers.</p>
    </div>
</div>

<div class="wrap">
    <div class="panel filters-top">
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr><th>Section</th><th>Photo of</th><th>Credit and licence</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            <td class="muted nowrap">{{ $row['section'] }}</td>
                            <td><b>{{ $row['name'] }}</b>@if ($row['where'])<span class="muted">, {{ $row['where'] }}</span>@endif</td>
                            <td class="mono small">{{ $row['credit'] }}</td>
                            <td class="nowrap">
                                @if ($row['source'])
                                    <a class="link small" href="{{ $row['source'] }}" rel="noopener" target="_blank">Source <x-icon name="external" size="sm" /></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
