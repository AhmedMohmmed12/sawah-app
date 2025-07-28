@extends('layouts.app')

@section('title', 'Explore Destinations - Sawah')

@section('content')
<div class="explore-container">
    <!-- Hero Section -->
    <section class="explore-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="explore-title">Where to?</h1>
                    <p class="explore-subtitle">Choose your next destination and discover amazing places around the world</p>
                    <div class="explore-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $countries->count() }}</span>
                            <span class="stat-label">Countries</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ App\Models\Attraction::count() }}</span>
                            <span class="stat-label">Attractions</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ App\Models\Hotel::count() }}</span>
                            <span class="stat-label">Hotels</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="explore-illustration">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Attractions -->
    <section class="attractions-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Featured Attractions</h2>
                <p class="section-subtitle">Discover the most popular attractions around the world</p>
            </div>
            
            <div class="row g-4">
                @foreach($countries->take(6) as $country)
                    @if($country->attractions->count() > 0)
                        @php
                            $featuredAttraction = $country->attractions->first();
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="attraction-card">
                                <div class="attraction-image">
                                    <img src="{{ $featuredAttraction->image }}" alt="{{ $featuredAttraction->name }}">
                                    <div class="attraction-overlay">
                                        <a href="{{ route('country.show', $country->id) }}" class="explore-btn">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="attraction-content">
                                    <div class="attraction-badge">{{ $featuredAttraction->type }}</div>
                                    <h3>{{ $featuredAttraction->name }}</h3>
                                    <p class="country-name">{{ $country->name }}</p>
                                    @if($featuredAttraction->description)
                                        <p class="attraction-description">{{ Str::limit($featuredAttraction->description, 80) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Top Destinations -->
    <section class="destinations-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Top Destinations</h2>
                <p class="section-subtitle">Explore our most popular countries</p>
            </div>
            
            <div class="row g-4">
                @foreach($countries->take(6) as $country)
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('country.show', $country->id) }}" class="destination-link">
                        <div class="destination-mini-card">
                            <div class="destination-mini-image">
                                <img src="{{ $country->image }}" alt="{{ $country->name }}">
                            </div>
                            <div class="destination-mini-content">
                                <h4>{{ $country->name }}</h4>
                                <span class="currency">{{ $country->currency }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Currency Exchange -->
    <section class="currency-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Currency Exchange Rates</h2>
                <p class="section-subtitle">Current rates to Saudi Riyal (SAR)</p>
            </div>
            
            <div class="currency-table-container">
                <div class="currency-table">
                    <div class="currency-header">
                        <div class="currency-col">Country</div>
                        <div class="currency-col">Currency</div>
                        <div class="currency-col">Rate to SAR</div>
                    </div>
                    @foreach($countries as $country)
                    <div class="currency-row">
                        <div class="currency-col">
                            <div class="country-info">
                                <img src="{{ $country->image }}" alt="{{ $country->name }}">
                                <span>{{ $country->name }}</span>
                            </div>
                        </div>
                        <div class="currency-col">{{ $country->currency }}</div>
                        <div class="currency-col">{{ number_format($country->exchange_rate_to_sar, 2) }} SAR</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Hotels -->
    <section class="hotels-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Popular Hotels</h2>
                <p class="section-subtitle">Top accommodations in our destinations</p>
            </div>
            
            <div class="row g-4">
                @foreach($countries->take(3) as $country)
                    @foreach($country->hotels->take(1) as $hotel)
                    <div class="col-lg-4 col-md-6">
                        <div class="hotel-card">
                            <div class="hotel-header">
                                <h3>{{ $hotel->name }}</h3>
                                <p class="hotel-location">{{ $country->name }}</p>
                            </div>
                            <div class="hotel-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $hotel->stars ? 'star-filled' : 'star-empty' }}"></i>
                                @endfor
                            </div>
                            <div class="hotel-price">
                                <span class="price">${{ $hotel->price_per_night }}</span>
                                <span class="per-night">per night</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div class="cta-content">
                    <h2>Ready to Plan Your Trip?</h2>
                    <p>Let us help you find the perfect destination based on your preferences and budget.</p>
                    <a href="{{ route('destination.suggest') }}" class="cta-btn">
                        <i class="fas fa-search"></i>
                        <span>Find Your Destination</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.explore-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.explore-hero {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 0 0 2rem 2rem;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.explore-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.explore-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.explore-stats {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: white;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.explore-illustration {
    font-size: 6rem;
    color: rgba(255,255,255,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.attractions-section, .destinations-section, .currency-section, .hotels-section, .cta-section {
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

.attraction-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    height: 100%;
}

.attraction-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.attraction-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.attraction-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.attraction-card:hover .attraction-image img {
    transform: scale(1.1);
}

.attraction-overlay {
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

.attraction-card:hover .attraction-overlay {
    opacity: 1;
}

.explore-btn {
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

.explore-btn:hover {
    transform: scale(1.1);
    color: white;
}

.attraction-content {
    padding: 1.5rem;
}

.attraction-badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.attraction-content h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.3rem;
}

.country-name {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.attraction-description {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

.destination-link {
    text-decoration: none;
    color: inherit;
}

.destination-mini-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.destination-mini-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.destination-mini-image {
    height: 120px;
    overflow: hidden;
}

.destination-mini-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.destination-mini-card:hover .destination-mini-image img {
    transform: scale(1.1);
}

.destination-mini-content {
    padding: 1rem;
    text-align: center;
}

.destination-mini-content h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.3rem;
}

.currency {
    font-size: 0.8rem;
    color: #666;
}

.currency-table-container {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.currency-table {
    width: 100%;
}

.currency-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 2px solid rgba(0,0,0,0.1);
    font-weight: 600;
    color: #333;
}

.currency-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    transition: background-color 0.3s ease;
}

.currency-row:hover {
    background-color: rgba(102, 126, 234, 0.05);
    border-radius: 0.5rem;
}

.currency-col {
    display: flex;
    align-items: center;
}

.country-info {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.country-info img {
    width: 30px;
    height: 20px;
    object-fit: cover;
    border-radius: 0.3rem;
}

.hotel-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    height: 100%;
}

.hotel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.hotel-header h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.3rem;
}

.hotel-location {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1rem;
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

.hotel-price {
    display: flex;
    align-items: baseline;
    gap: 0.3rem;
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
    .explore-title {
        font-size: 2.5rem;
    }
    
    .explore-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .explore-illustration {
        font-size: 4rem;
        margin-top: 2rem;
    }
    
    .currency-header, .currency-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .currency-header {
        display: none;
    }
    
    .currency-row {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .currency-col {
        justify-content: center;
    }
}
</style>
@endsection