@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6">
        <div class="text-center">
            <div class="text-6xl font-bold text-red-500 mb-4">403</div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Access Forbidden</h1>
            <p class="text-gray-600 mb-6">You don't have permission to access this page.</p>
            
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Go to Home
                </a>
                <a href="{{ route('dashboard') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Go to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 