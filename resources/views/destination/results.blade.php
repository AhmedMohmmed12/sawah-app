{{-- resources/views/destination/results.blade.php --}}
@extends('layouts.app')

@section('title', 'Destination Recommendations - Sawah')

@section('content')
<div class="results-container">
    <!-- Hero Section -->
    <section class="results-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="results-title">Recommended Destinations</h1>
                    <p class="results-subtitle">Based on your preferences, here are the perfect destinations for your next adventure</p>
                    <div class="results-actions">
                        <a href="{{ route('destination.suggest') }}" class="action-btn secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span>New Search</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="results-illustration">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="results-section">
        <div class="container">
            @if($recommendations->isEmpty())
                <div class="no-results-card">
                    <div class="no-results-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2>No matches found</h2>
                    <p>We couldn't find any destinations matching your criteria. Try adjusting your preferences:</p>
                    <div class="suggestions">
                        <div class="suggestion-item">
                            <i class="fas fa-coins"></i>
                            <span>Expand your budget range</span>
                        </div>
                        <div class="suggestion-item">
                            <i class="fas fa-cloud-sun"></i>
                            <span>Try different weather preferences</span>
                        </div>
                        <div class="suggestion-item">
                            <i class="fas fa-plane"></i>
                            <span>Select a different trip type</span>
                        </div>
                    </div>
                    <a href="{{ route('destination.suggest') }}" class="try-again-btn">
                        <i class="fas fa-redo"></i>
                        <span>Try Again</span>
                    </a>
                </div>
            @else
                <div class="results-grid">
                    @foreach($recommendations as $country)
                        <div class="result-card">
                            <div class="result-image">
                                @if($country->image)
                                    <img src="{{ $country->image }}" alt="{{ $country->name }}">
                                @endif
                                <div class="result-overlay">
                                    <a href="{{ route('country.show', $country->id) }}" class="view-btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="result-content">
                                <h3>{{ $country->name }}</h3>
                                <p>{{ Str::limit($country->description, 100) }}</p>
                                
                                <div class="result-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-cloud-sun"></i>
                                        <div>
                                            <span class="meta-label">Climate</span>
                                            <span class="meta-value">{{ $country->climate }}</span>
                                        </div>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-dollar-sign"></i>
                                        <div>
                                            <span class="meta-label">Daily Budget</span>
                                            <span class="meta-value">${{ $country->daily_budget_min }}-{{ $country->daily_budget_max }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('country.show', $country->id) }}" class="explore-btn">
                                    <span>View Details</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($request->budget || $request->weather || $request->trip_type)
                    <div class="search-criteria">
                        <div class="criteria-header">
                            <i class="fas fa-filter"></i>
                            <h3>Search Criteria</h3>
                        </div>
                        <div class="criteria-items">
                            @if($request->budget)
                                <div class="criteria-item">
                                    <span class="criteria-label">Budget:</span>
                                    <span class="criteria-value">{{ $request->budget }}</span>
                                </div>
                            @endif
                            @if($request->weather)
                                <div class="criteria-item">
                                    <span class="criteria-label">Weather:</span>
                                    <span class="criteria-value">{{ $request->weather }}</span>
                                </div>
                            @endif
                            @if($request->trip_type)
                                <div class="criteria-item">
                                    <span class="criteria-label">Trip Type:</span>
                                    <span class="criteria-value">{{ $request->trip_type }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>
</div>

<style>
.results-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.results-hero {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 0 0 2rem 2rem;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.results-title {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.results-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.results-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    border-radius: 2rem;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-btn.secondary {
    background: rgba(255,255,255,0.2);
    color: white;
    border-color: rgba(255,255,255,0.3);
}

.action-btn.secondary:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-3px);
    color: white;
}

.results-illustration {
    font-size: 6rem;
    color: rgba(255,255,255,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.results-section {
    padding: 2rem 0 4rem;
}

.no-results-card {
    background: rgba(255,255,255,0.95);
    border-radius: 2rem;
    padding: 4rem 3rem;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.no-results-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    font-size: 3rem;
    color: white;
}

.no-results-card h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 1rem;
}

.no-results-card p {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.suggestions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.suggestion-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 1rem;
    color: #667eea;
}

.suggestion-item i {
    font-size: 1.2rem;
}

.try-again-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.try-again-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.result-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.result-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.result-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.result-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.result-card:hover .result-image img {
    transform: scale(1.1);
}

.result-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.result-card:hover .result-overlay {
    opacity: 1;
}

.view-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.view-btn:hover {
    transform: scale(1.1);
    color: white;
}

.result-content {
    padding: 1.5rem;
}

.result-content h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.result-content p {
    color: #666;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.result-meta {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.meta-item i {
    color: #667eea;
    font-size: 1.1rem;
    width: 20px;
}

.meta-item div {
    display: flex;
    flex-direction: column;
}

.meta-label {
    font-size: 0.8rem;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.meta-value {
    font-weight: 600;
    color: #333;
}

.explore-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0.8rem 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.explore-btn:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

.search-criteria {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.criteria-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.criteria-header i {
    color: #667eea;
    font-size: 1.5rem;
}

.criteria-header h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.criteria-items {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.criteria-item {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

.criteria-label {
    font-size: 0.9rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.criteria-value {
    font-weight: 600;
    color: #333;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .results-title {
        font-size: 2.5rem;
    }
    
    .results-illustration {
        font-size: 4rem;
        margin-top: 2rem;
    }
    
    .results-grid {
        grid-template-columns: 1fr;
    }
    
    .no-results-card {
        padding: 2rem;
    }
    
    .criteria-items {
        flex-direction: column;
        gap: 1rem;
    }
    
    .suggestions {
        align-items: center;
    }
}
</style>
@endsection 