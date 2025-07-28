@extends('layouts.app')

@section('title', 'Dashboard - Sawah')

@section('content')
<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="hero-section-dashboard">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="hero-title">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    @if(Auth::user()->hasRole('user'))
                        <p class="hero-subtitle">Ready to plan your next adventure? Let's explore the world together.</p>
                    @else
                        <p class="hero-subtitle">Welcome to the admin panel. Manage your travel platform content efficiently.</p>
                    @endif
                    <div class="hero-stats">
                        @if(Auth::user()->hasRole('user'))
                            <div class="stat-item">
                                <span class="stat-number">{{ Auth::user()->search_count ?? 0 }}</span>
                                <span class="stat-label">Searches</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ Auth::user()->favorites_count ?? 0 }}</span>
                                <span class="stat-label">Favorites</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ App\Models\Country::count() }}</span>
                                <span class="stat-label">Countries</span>
                            </div>
                        @else
                            <div class="stat-item">
                                <span class="stat-number">{{ App\Models\Country::count() }}</span>
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
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="hero-illustration">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="container mt-5">
        <div class="section-header">
            <h2 class="section-title">Quick Actions</h2>
            <p class="section-subtitle">Get started with your travel planning</p>
        </div>
        
        <div class="row g-4">
            @if(Auth::user()->hasRole('user'))
                <div class="col-lg-4 col-md-6">
                    <div class="action-card explore-card">
                        <div class="card-icon">
                            <i class="fas fa-compass"></i>
                        </div>
                        <div class="card-content">
                            <h3>Explore Destinations</h3>
                            <p>Discover amazing countries and their unique attractions around the world.</p>
                            <a href="{{ route('explore') }}" class="action-btn">
                                <span>Explore Now</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="action-card search-card">
                        <div class="card-icon">
                            <i class="fas fa-search-location"></i>
                        </div>
                        <div class="card-content">
                            <h3>Find Your Destination</h3>
                            <p>Get personalized recommendations based on your preferences and budget.</p>
                            <a href="{{ route('destination.suggest') }}" class="action-btn">
                                <span>Find Destination</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="action-card profile-card">
                        <div class="card-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="card-content">
                            <h3>Manage Profile</h3>
                            <p>Update your preferences and travel interests for better recommendations.</p>
                            <a href="{{ route('profile.overview') }}" class="action-btn">
                                <span>View Profile</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-6 col-md-6">
                    <div class="action-card admin-card">
                        <div class="card-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="card-content">
                            <h3>Admin Panel</h3>
                            <p>Access the admin dashboard to manage countries, attractions, and hotels.</p>
                            <a href="{{ route('admin.dashboard') }}" class="action-btn">
                                <span>Go to Admin Panel</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="action-card profile-card">
                        <div class="card-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="card-content">
                            <h3>Admin Profile</h3>
                            <p>Manage your admin account settings and preferences.</p>
                            <a href="{{ route('admin.profile.edit') }}" class="action-btn">
                                <span>View Profile</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="container mt-5">
        <div class="section-header">
            <h2 class="section-title">Platform Overview</h2>
            @if(Auth::user()->hasRole('user'))
                <p class="section-subtitle">Discover what's available on Sawah</p>
            @else
                <p class="section-subtitle">Platform statistics and management overview</p>
            @endif
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card countries-card">
                    <div class="stat-icon">
                        <i class="fas fa-flag"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ App\Models\Country::count() }}</h3>
                        <p>Countries Available</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card attractions-card">
                    <div class="stat-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ App\Models\Attraction::count() }}</h3>
                        <p>Attractions</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card hotels-card">
                    <div class="stat-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ App\Models\Hotel::count() }}</h3>
                        <p>Hotels</p>
                    </div>
                </div>
            </div>
            
            @if(Auth::user()->hasRole('user'))
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card users-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ App\Models\User::count() }}</h3>
                            <p>Registered Users</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card users-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ App\Models\User::where('role', 'user')->count() }}</h3>
                            <p>Regular Users</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity & Tips -->
    <div class="container mt-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="activity-section">
                    <div class="section-header">
                        <h2 class="section-title">Recent Activity</h2>
                    </div>
                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="activity-content">
                            @if(Auth::user()->hasRole('user'))
                                <h4>Welcome to Sawah!</h4>
                                <p>This is your personal travel hub. As you explore destinations and save favorites, your activity will appear here to help you track your travel planning journey.</p>
                            @else
                                <h4>Welcome to Sawah Admin!</h4>
                                <p>This is your admin dashboard. You can manage countries, attractions, and hotels from the admin panel. Use the navigation above to access different management sections.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="tips-section">
                    <div class="section-header">
                        <h2 class="section-title">Travel Tips</h2>
                    </div>
                    <div class="tips-card">
                        @if(Auth::user()->hasRole('user'))
                            <div class="tip-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Update your travel preferences for better recommendations</span>
                            </div>
                            <div class="tip-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Save your favorite destinations for quick access</span>
                            </div>
                            <div class="tip-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Use the destination finder to discover new places</span>
                            </div>
                        @else
                            <div class="tip-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Regularly update country information for better user experience</span>
                            </div>
                            <div class="tip-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Add high-quality images for attractions and hotels</span>
                            </div>
                            <div class="tip-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Keep hotel pricing and attraction details current</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding-bottom: 3rem;
}

.hero-section-dashboard {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 0 0 2rem 2rem;
    padding: 4rem 0;
    margin-bottom: 2rem;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
}

.hero-stats {
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

.hero-illustration {
    font-size: 8rem;
    color: rgba(255,255,255,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
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

.action-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.action-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.card-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    font-size: 2rem;
    color: white;
}

.explore-card .card-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.search-card .card-icon {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.profile-card .card-icon {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.admin-card .card-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.card-content p {
    color: #666;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 2rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: translateX(5px);
    color: white;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.stat-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.countries-card .stat-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.attractions-card .stat-icon {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.hotels-card .stat-icon {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.users-card .stat-icon {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.stat-info h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.stat-info p {
    color: #666;
    font-weight: 500;
    margin: 0;
}

.activity-section, .tips-section {
    margin-bottom: 2rem;
}

.activity-card, .tips-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    padding: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.activity-card {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
}

.activity-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.activity-content h4 {
    color: #333;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.activity-content p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.tip-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.tip-item:last-child {
    border-bottom: none;
}

.tip-item i {
    color: #667eea;
    font-size: 1.1rem;
}

.tip-item span {
    color: #666;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .hero-illustration {
        font-size: 5rem;
        margin-top: 2rem;
    }
}
</style>
@endsection
