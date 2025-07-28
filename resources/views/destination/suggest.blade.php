{{-- resources/views/destination/suggest.blade.php --}}
@extends('layouts.app')

@section('title', 'Suggest Destination - Sawah')

@section('content')
<div class="suggest-container">
    <!-- Hero Section -->
    <section class="suggest-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="suggest-title">Find Your Perfect Destination</h1>
                    <p class="suggest-subtitle">Tell us about your preferences and we'll recommend the best destinations for your next adventure.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="suggest-illustration">
                        <i class="fas fa-search-location"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-card">
                        <div class="form-header">
                            <div class="form-icon">
                                <i class="fas fa-compass"></i>
                            </div>
                            <h2>Destination Preferences</h2>
                            <p>Fill in your travel preferences to get personalized recommendations</p>
                        </div>

                        @if(session('error'))
                            <div class="alert-modern error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert-modern error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div>
                                    <strong>Please fix the following errors:</strong>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('destination.find') }}" class="preference-form">
                            @csrf
                            
                            <div class="form-group">
                                <label for="budget" class="form-label">
                                    <i class="fas fa-dollar-sign"></i>
                                    Budget Range (per day)
                                </label>
                                <input type="text" 
                                       class="form-input @error('budget') is-invalid @enderror" 
                                       id="budget" 
                                       name="budget" 
                                       value="{{ old('budget') }}"
                                       placeholder="e.g. 100-300">
                                <div class="form-help">Enter your daily budget range (minimum-maximum)</div>
                                @error('budget')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="weather" class="form-label">
                                    <i class="fas fa-cloud-sun"></i>
                                    Preferred Weather
                                </label>
                                <select class="form-select @error('weather') is-invalid @enderror" 
                                        id="weather" 
                                        name="weather">
                                    <option value="">Select weather preference</option>
                                    <option value="Warm" {{ old('weather') == 'Warm' ? 'selected' : '' }}>Warm</option>
                                    <option value="Mild" {{ old('weather') == 'Mild' ? 'selected' : '' }}>Mild</option>
                                    <option value="Cold" {{ old('weather') == 'Cold' ? 'selected' : '' }}>Cold</option>
                                    <option value="No preference" {{ old('weather') == 'No preference' ? 'selected' : '' }}>No preference</option>
                                </select>
                                @error('weather')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="trip_type" class="form-label">
                                    <i class="fas fa-plane"></i>
                                    Trip Type
                                </label>
                                <select class="form-select @error('trip_type') is-invalid @enderror" 
                                        id="trip_type" 
                                        name="trip_type">
                                    <option value="">Select trip type</option>
                                    <option value="Adventure" {{ old('trip_type') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                                    <option value="Relaxation" {{ old('trip_type') == 'Relaxation' ? 'selected' : '' }}>Relaxation</option>
                                    <option value="Cultural" {{ old('trip_type') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                    <option value="Business" {{ old('trip_type') == 'Business' ? 'selected' : '' }}>Business</option>
                                    <option value="Family" {{ old('trip_type') == 'Family' ? 'selected' : '' }}>Family</option>
                                </select>
                                @error('trip_type')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-search"></i>
                                    <span>Find Destinations</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3>Smart Matching</h3>
                        <p>Our AI analyzes your preferences to find the perfect destinations for your travel style.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Budget Optimization</h3>
                        <p>Get recommendations that fit your budget with accurate cost estimates and currency rates.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Quick Results</h3>
                        <p>Receive personalized destination suggestions instantly based on your preferences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.suggest-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.suggest-hero {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 0 0 2rem 2rem;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.suggest-title {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.suggest-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
}

.suggest-illustration {
    font-size: 6rem;
    color: rgba(255,255,255,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.form-section {
    padding: 2rem 0 4rem;
}

.form-card {
    background: rgba(255,255,255,0.95);
    border-radius: 2rem;
    padding: 3rem;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.form-header {
    text-align: center;
    margin-bottom: 3rem;
}

.form-icon {
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

.form-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-header p {
    color: #666;
    font-size: 1.1rem;
}

.alert-modern {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.alert-modern.error {
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid rgba(220, 53, 69, 0.2);
    color: #dc3545;
}

.alert-modern i {
    font-size: 1.2rem;
    margin-top: 0.1rem;
}

.alert-modern ul {
    margin: 0.5rem 0 0 0;
    padding-left: 1.5rem;
}

.preference-form {
    max-width: 100%;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.8rem;
    font-size: 1rem;
}

.form-label i {
    color: #667eea;
}

.form-input, .form-select {
    width: 100%;
    padding: 1rem 1.5rem;
    border: 2px solid rgba(102, 126, 234, 0.2);
    border-radius: 1rem;
    font-size: 1rem;
    background: rgba(255,255,255,0.8);
    transition: all 0.3s ease;
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
}

.form-help {
    font-size: 0.9rem;
    color: #666;
    margin-top: 0.5rem;
}

.form-error {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.form-actions {
    text-align: center;
    margin-top: 3rem;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 3rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.features-section {
    padding: 4rem 0;
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

@media (max-width: 768px) {
    .suggest-title {
        font-size: 2.5rem;
    }
    
    .suggest-illustration {
        font-size: 4rem;
        margin-top: 2rem;
    }
    
    .form-card {
        padding: 2rem;
    }
    
    .form-header h2 {
        font-size: 1.8rem;
    }
    
    .submit-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection 