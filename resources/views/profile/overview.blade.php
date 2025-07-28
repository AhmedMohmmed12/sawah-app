@extends('layouts.app')

@section('title', 'Profile Overview - Sawah')

@section('content')
<div class="profile-container">
    <!-- Hero Section -->
    <section class="profile-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="profile-title">Profile Overview</h1>
                    @if($user->hasRole('user'))
                        <p class="profile-subtitle">Your travel journey with Sawah</p>
                    @else
                        <p class="profile-subtitle">Admin profile and platform management</p>
                    @endif
                    <div class="profile-stats">
                        @if($user->hasRole('user'))
                            <div class="stat-item">
                                <span class="stat-number">{{ $user->search_count }}</span>
                                <span class="stat-label">Searches</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ $user->favorites_count }}</span>
                                <span class="stat-label">Favorites</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ $user->created_at->diffInDays(now()) }}</span>
                                <span class="stat-label">Days</span>
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
                    <div class="profile-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="profile-content">
        <div class="container">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    @if($user->hasRole('user'))
                        <!-- Travel Preferences -->
                        <div class="preferences-card">
                            <div class="card-header">
                                <div class="header-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <h2>Your Travel Preferences</h2>
                            </div>
                            <div class="card-body">
                                <div class="preferences-grid">
                                    <div class="preference-item">
                                        <div class="preference-icon">
                                            <i class="fas fa-cloud-sun"></i>
                                        </div>
                                        <div class="preference-content">
                                            <h3>Preferred Climate</h3>
                                            @if($user->preferred_climate)
                                                <span class="preference-value">{{ ucfirst($user->preferred_climate) }}</span>
                                            @else
                                                <span class="preference-empty">Not set</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="preference-item">
                                        <div class="preference-icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                        <div class="preference-content">
                                            <h3>Budget Range</h3>
                                            @if($user->budget_range)
                                                <span class="preference-value">{{ $user->budget_range }}</span>
                                            @else
                                                <span class="preference-empty">Not set</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                @if($user->travel_interests && count($user->travel_interests) > 0)
                                    <div class="interests-section">
                                        <h3>Travel Interests</h3>
                                        <div class="interests-grid">
                                            @foreach($user->travel_interests as $interest)
                                                <span class="interest-badge">{{ ucfirst($interest) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="interests-section">
                                        <h3>Travel Interests</h3>
                                        <p class="no-interests">No interests selected yet</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Recent Activity -->
                    <div class="activity-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <h2>Recent Activity</h2>
                        </div>
                        <div class="card-body">
                            @if($user->hasRole('user'))
                                @if($user->search_count > 0)
                                    <div class="activity-message success">
                                        <div class="message-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="message-content">
                                            <h4>Great Progress!</h4>
                                            <p>You've searched for {{ $user->search_count }} destination{{ $user->search_count > 1 ? 's' : '' }}.
                                            @if($user->search_count < 5)
                                                Keep exploring to discover more amazing places!
                                            @else
                                                You're becoming a travel expert!
                                            @endif</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="activity-message warning">
                                        <div class="message-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="message-content">
                                            <h4>Get Started!</h4>
                                            <p>You haven't searched for any destinations yet. 
                                            <a href="{{ route('destination.suggest') }}">Start exploring now</a>.</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="activity-message success">
                                    <div class="message-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="message-content">
                                        <h4>Admin Dashboard</h4>
                                        <p>You have access to manage {{ App\Models\Country::count() }} countries, 
                                        {{ App\Models\Attraction::count() }} attractions, and 
                                        {{ App\Models\Hotel::count() }} hotels. 
                                        <a href="{{ route('admin.dashboard') }}">Go to admin panel</a>.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Profile Summary -->
                    <div class="summary-card">
                        <div class="summary-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h3>{{ $user->name }}</h3>
                        <p class="user-email">{{ $user->email }}</p>
                        <p class="member-since">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="actions-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h2>Quick Actions</h2>
                        </div>
                        <div class="card-body">
                            <div class="actions-grid">
                                <a href="{{ route('profile.edit') }}" class="action-item">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                                @if($user->hasRole('user'))
                                    <a href="{{ route('destination.suggest') }}" class="action-item">
                                        <i class="fas fa-search"></i>
                                        <span>Find Destination</span>
                                    </a>
                                    <a href="{{ route('explore') }}" class="action-item">
                                        <i class="fas fa-globe"></i>
                                        <span>Explore Destinations</span>
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" class="action-item">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Travel Tips -->
                    <div class="tips-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h2>Travel Tips</h2>
                        </div>
                        <div class="card-body">
                            <div class="tips-list">
                                @if($user->hasRole('user'))
                                    <div class="tip-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Set your travel preferences for better recommendations</span>
                                    </div>
                                    <div class="tip-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Explore different countries and their attractions</span>
                                    </div>
                                    <div class="tip-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Use the destination finder for personalized suggestions</span>
                                    </div>
                                @else
                                    <div class="tip-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Manage platform content efficiently</span>
                                    </div>
                                    <div class="tip-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Keep country and attraction information updated</span>
                                    </div>
                                    <div class="tip-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Monitor user activity and platform statistics</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.profile-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.profile-hero {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border-radius: 0 0 2rem 2rem;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.profile-title {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.profile-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
}

.profile-stats {
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

.profile-avatar {
    font-size: 8rem;
    color: rgba(255,255,255,0.3);
}

.profile-content {
    padding: 2rem 0 4rem;
}

.preferences-card, .activity-card, .summary-card, .actions-card, .tips-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.card-header h2 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}

.card-body {
    padding: 2rem;
}

.preferences-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.preference-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 1rem;
}

.preference-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: white;
}

.preference-content h3 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.3rem;
}

.preference-value {
    color: #667eea;
    font-weight: 600;
}

.preference-empty {
    color: #999;
    font-style: italic;
}

.interests-section h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
}

.interests-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.interest-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.9rem;
    font-weight: 500;
}

.no-interests {
    color: #999;
    font-style: italic;
}

.activity-message {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 1rem;
}

.activity-message.success {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.activity-message.warning {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.2);
}

.message-icon {
    font-size: 1.5rem;
    margin-top: 0.2rem;
}

.activity-message.success .message-icon {
    color: #28a745;
}

.activity-message.warning .message-icon {
    color: #ffc107;
}

.message-content h4 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.message-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

.message-content a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
}

.summary-card {
    text-align: center;
    padding: 2rem;
}

.summary-avatar {
    font-size: 4rem;
    color: #667eea;
    margin-bottom: 1rem;
}

.summary-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.user-email {
    color: #666;
    margin-bottom: 0.5rem;
}

.member-since {
    color: #999;
    font-size: 0.9rem;
}

.actions-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.action-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 1rem;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
}

.action-item:hover {
    background: rgba(102, 126, 234, 0.2);
    transform: translateX(5px);
    color: #333;
    text-decoration: none;
}

.action-item i {
    color: #667eea;
    font-size: 1.2rem;
    width: 20px;
}

.tips-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.tip-item i {
    color: #28a745;
    font-size: 1.1rem;
    margin-top: 0.2rem;
}

.tip-item span {
    color: #666;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .profile-title {
        font-size: 2.5rem;
    }
    
    .profile-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .profile-avatar {
        font-size: 5rem;
        margin-top: 2rem;
    }
    
    .preferences-grid {
        grid-template-columns: 1fr;
    }
    
    .activity-message {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endsection 