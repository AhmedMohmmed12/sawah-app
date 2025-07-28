{{-- resources/views/country/show.blade.php --}}
@extends('layouts.app')

@section('title', $country->name . ' - Sawah')

@section('content')
<div class="country-container">
    <!-- Hero Section -->
    <section class="country-hero">
        <div class="hero-background">
            @if($country->image)
                <img src="{{ $country->image }}" alt="{{ $country->name }}">
            @endif
            <div class="hero-overlay"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <h1 class="country-title">{{ $country->name }}</h1>
                <p class="country-subtitle">{{ $country->description }}</p>
                <div class="hero-actions">
                    <a href="{{ route('explore') }}" class="action-btn secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Explore</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Country Info Section -->
    <section class="info-section">
        <div class="container">
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-cloud-sun"></i>
                    </div>
                    <div class="info-content">
                        <h3>Climate</h3>
                        <p>{{ $country->climate }}</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="info-content">
                        <h3>Daily Budget</h3>
                        <p>${{ $country->daily_budget_min }} - ${{ $country->daily_budget_max }}</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-flag"></i>
                    </div>
                    <div class="info-content">
                        <h3>Currency</h3>
                        <p>{{ $country->currency }}</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Exchange Rate</h3>
                        <p>{{ $country->exchange_rate_to_sar }} SAR</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Attractions Section -->
    @if($country->attractions->count() > 0)
        <section class="attractions-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Attractions</h2>
                    <p class="section-subtitle">Discover amazing places in {{ $country->name }}</p>
                </div>
                
                <div class="attractions-grid">
                    @foreach($country->attractions as $attraction)
                        <div class="attraction-card">
                            <div class="attraction-image">
                                @if($attraction->image)
                                    <img src="{{ $attraction->image }}" alt="{{ $attraction->name }}">
                                @endif
                                <div class="attraction-badge">{{ $attraction->type }}</div>
                            </div>
                            <div class="attraction-content">
                                <h3>{{ $attraction->name }}</h3>
                                @if($attraction->description)
                                    <p>{{ Str::limit($attraction->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Hotels Section -->
    @if($country->hotels->count() > 0)
        <section class="hotels-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Hotels</h2>
                    <p class="section-subtitle">Best accommodations in {{ $country->name }}</p>
                </div>
                
                <div class="hotels-grid">
                    @foreach($country->hotels as $hotel)
                        <div class="hotel-card">
                            <div class="hotel-image">
                                @if($hotel->image)
                                    <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
                                @endif
                            </div>
                            <div class="hotel-content">
                                <h3>{{ $hotel->name }}</h3>
                                <div class="hotel-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $hotel->stars ? 'star-filled' : 'star-empty' }}"></i>
                                    @endfor
                                    <span class="rating-text">({{ $hotel->stars }} stars)</span>
                                </div>
                                <div class="hotel-price">
                                    <span class="price">${{ $hotel->price_per_night }}</span>
                                    <span class="per-night">per night</span>
                                </div>
                                @if($hotel->description)
                                    <p>{{ Str::limit($hotel->description, 80) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div class="cta-content">
                    <h2>Ready to Visit {{ $country->name }}?</h2>
                    <p>Start planning your trip with personalized recommendations and travel tips.</p>
                    <a href="{{ route('destination.suggest') }}" class="cta-btn">
                        <i class="fas fa-compass"></i>
                        <span>Plan Your Trip</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.country-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.country-hero {
    position: relative;
    height: 60vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.hero-background img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
    text-align: center;
}

.country-title {
    font-size: 4rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.country-subtitle {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    line-height: 1.6;
}

.hero-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
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

.info-section {
    padding: 4rem 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.info-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.info-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.8rem;
    color: white;
}

.info-content h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.info-content p {
    color: #666;
    font-weight: 500;
    margin: 0;
}

.attractions-section, .hotels-section {
    padding: 4rem 0;
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

.attractions-grid, .hotels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.attraction-card, .hotel-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.attraction-card:hover, .hotel-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.attraction-image, .hotel-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.attraction-image img, .hotel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.attraction-card:hover .attraction-image img,
.hotel-card:hover .hotel-image img {
    transform: scale(1.1);
}

.attraction-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 600;
}

.attraction-content, .hotel-content {
    padding: 1.5rem;
}

.attraction-content h3, .hotel-content h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.attraction-content p, .hotel-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

.hotel-rating {
    margin-bottom: 1rem;
}

.star-filled {
    color: #ffc107;
}

.star-empty {
    color: #ddd;
}

.rating-text {
    color: #666;
    font-size: 0.9rem;
    margin-left: 0.5rem;
}

.hotel-price {
    display: flex;
    align-items: baseline;
    gap: 0.3rem;
    margin-bottom: 1rem;
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
}

.per-night {
    font-size: 0.9rem;
    color: #666;
}

.cta-section {
    padding: 4rem 0;
}

.cta-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 2rem;
    padding: 3rem;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.2);
}

.cta-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.cta-content p {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    color: white;
    text-decoration: none;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

@media (max-width: 768px) {
    .country-title {
        font-size: 2.5rem;
    }
    
    .country-subtitle {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .attractions-grid, .hotels-grid {
        grid-template-columns: 1fr;
    }
    
    .country-hero {
        height: 50vh;
    }
}
</style>
@endsection 