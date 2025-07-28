@extends('layouts.app')

@section('title', 'Sawah - Tourism Made Easy and Smart')

@section('content')
<div class="home-container">
    <!-- Hero Section -->
    <section class="hero-section-modern">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="hero-title">Tourism made easy and smart.</h1>
                    <p class="hero-subtitle">Plan the trip of your dreams with personalized recommendations and smart travel insights.</p>
                    <div class="hero-actions">
                        <a href="{{ route('destination.suggest') }}" class="hero-btn primary">
                            <i class="fas fa-compass"></i>
                            <span>Suggest a Destination</span>
                        </a>
                        <a href="{{ route('explore') }}" class="hero-btn secondary">
                            <i class="fas fa-globe"></i>
                            <span>Explore Destinations</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="hero-illustration">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="destinations-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Popular Destinations</h2>
                <p class="section-subtitle">Discover amazing places around the world</p>
            </div>
            
            <div class="row g-4">
                @foreach($featuredCountries as $country)
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="destination-image">
                            <img src="{{ $country->image }}" alt="{{ $country->name }}">
                            <div class="destination-overlay">
                                <a href="{{ route('country.show', $country->id) }}" class="explore-btn">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="destination-content">
                            <h3>{{ $country->name }}</h3>
                            <p>{{ Str::limit($country->description, 80) }}</p>
                            <div class="destination-meta">
                                <span class="currency">
                                    <i class="fas fa-coins"></i>
                                    {{ $country->currency }}
                                </span>
                                <span class="climate">
                                    <i class="fas fa-cloud-sun"></i>
                                    {{ $country->climate }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5 mb-0">
                <a href="{{ route('explore') }}" class="view-all-btn">
                    <span>View All Destinations</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Why Choose Sawah?</h2>
                <p class="section-subtitle">Your smart travel companion</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3>Smart Recommendations</h3>
                        <p>Get personalized destination suggestions based on your preferences, budget, and travel style.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h3>Budget Planning</h3>
                        <p>Plan your trip with accurate budget estimates and real-time currency exchange rates.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Best Accommodations</h3>
                        <p>Discover the most popular hotels and accommodations in your chosen destination.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ App\Models\Country::count() }}+</div>
                        <div class="stat-label">Countries</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ App\Models\Attraction::count() }}+</div>
                        <div class="stat-label">Attractions</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ App\Models\Hotel::count() }}+</div>
                        <div class="stat-label">Hotels</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ App\Models\User::count() }}+</div>
                        <div class="stat-label">Happy Travelers</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.home-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-section-modern {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 0 0 2rem 2rem;
    padding: 6rem 0;
    margin-bottom: 4rem;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border-radius: 2rem;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.hero-btn.primary {
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    color: white;
}

.hero-btn.primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

.hero-btn.secondary {
    background: rgba(255,255,255,0.2);
    color: white;
    border-color: rgba(255,255,255,0.3);
}

.hero-btn.secondary:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-3px);
    color: white;
}

.hero-illustration {
    font-size: 8rem;
    color: rgba(255,255,255,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.destinations-section, .features-section, .stats-section {
    padding: 4rem 0;
    margin-bottom: 0;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.8);
}

.destination-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.destination-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.destination-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.destination-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.destination-card:hover .destination-image img {
    transform: scale(1.1);
}

.destination-overlay {
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

.destination-card:hover .destination-overlay {
    opacity: 1;
}

.explore-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.explore-btn:hover {
    transform: scale(1.1);
    color: white;
}

.destination-content {
    padding: 1.5rem;
}

.destination-content h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.destination-content p {
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.destination-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
}

.destination-meta span {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: #888;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: rgba(255,255,255,0.2);
    color: white;
    text-decoration: none;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid rgba(255,255,255,0.3);
}

.view-all-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-3px);
    color: white;
}

.feature-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    text-align: center;
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
}

.feature-card h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
}

.feature-card p {
    color: #666;
    line-height: 1.6;
}

.stats-section {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 2rem;
    margin: 2rem 0 0 0;
}

.stat-item {
    text-align: center;
    padding: 2rem 1rem;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Remove any bottom spacing from the last section */
.stats-section:last-child {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

/* Ensure no margin on the home container */
.home-container {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-actions {
        flex-direction: column;
    }
    
    .hero-illustration {
        font-size: 5rem;
        margin-top: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
}
</style>
@endsection