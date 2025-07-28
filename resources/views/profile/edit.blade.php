@extends('layouts.app')

@section('title', 'Profile - Sawah')

@section('content')
<div class="profile-edit-container">
    <!-- Hero Section -->
    <section class="profile-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="profile-title">My Profile</h1>
                    <p class="profile-subtitle">Manage your account and travel preferences</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="profile-content">
        <div class="container">
            @if (session('status'))
                <div class="alert-modern success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="row g-4">
                <!-- Left Column - Forms -->
                <div class="col-lg-8">
                    <!-- Profile Information -->
                    <div class="form-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h2>Profile Information</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('profile.update') }}" class="profile-form">
                                @csrf
                                @method('patch')

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user"></i>
                                            Name
                                        </label>
                                        <input type="text" 
                                               class="form-input @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope"></i>
                                            Email
                                        </label>
                                        <input type="email" 
                                               class="form-input @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="submit-btn primary">
                                        <i class="fas fa-save"></i>
                                        <span>Save Changes</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="form-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h2>Change Password</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('password.update') }}" class="profile-form">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="current_password" class="form-label">
                                        <i class="fas fa-key"></i>
                                        Current Password
                                    </label>
                                    <input type="password" 
                                           class="form-input @error('current_password') is-invalid @enderror" 
                                           id="current_password" 
                                           name="current_password" 
                                           required>
                                    @error('current_password')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock"></i>
                                            New Password
                                        </label>
                                        <input type="password" 
                                               class="form-input @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               required>
                                        @error('password')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-lock"></i>
                                            Confirm New Password
                                        </label>
                                        <input type="password" 
                                               class="form-input" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="submit-btn warning">
                                        <i class="fas fa-key"></i>
                                        <span>Update Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Travel Preferences -->
                    <div class="form-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <h2>Travel Preferences</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('profile.travel-preferences') }}" class="profile-form">
                                @csrf
                                @method('patch')

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="preferred_climate" class="form-label">
                                            <i class="fas fa-cloud-sun"></i>
                                            Preferred Climate
                                        </label>
                                        <select class="form-select" id="preferred_climate" name="preferred_climate">
                                            <option value="">Select climate preference</option>
                                            <option value="warm" {{ $user->preferred_climate == 'warm' ? 'selected' : '' }}>Warm</option>
                                            <option value="mild" {{ $user->preferred_climate == 'mild' ? 'selected' : '' }}>Mild</option>
                                            <option value="cold" {{ $user->preferred_climate == 'cold' ? 'selected' : '' }}>Cold</option>
                                            <option value="no_preference" {{ $user->preferred_climate == 'no_preference' ? 'selected' : '' }}>No Preference</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="budget_range" class="form-label">
                                            <i class="fas fa-dollar-sign"></i>
                                            Budget Range (per day)
                                        </label>
                                        <select class="form-select" id="budget_range" name="budget_range">
                                            <option value="">Select budget range</option>
                                            <option value="50-100" {{ $user->budget_range == '50-100' ? 'selected' : '' }}>$50 - $100</option>
                                            <option value="100-200" {{ $user->budget_range == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                                            <option value="200-300" {{ $user->budget_range == '200-300' ? 'selected' : '' }}>$200 - $300</option>
                                            <option value="300-500" {{ $user->budget_range == '300-500' ? 'selected' : '' }}>$300 - $500</option>
                                            <option value="500+" {{ $user->budget_range == '500+' ? 'selected' : '' }}>$500+</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-heart"></i>
                                        Travel Interests
                                    </label>
                                    <div class="interests-grid">
                                        <div class="interest-item">
                                            <input class="interest-checkbox" type="checkbox" id="adventure" name="interests[]" value="adventure" {{ in_array('adventure', $user->travel_interests) ? 'checked' : '' }}>
                                            <label class="interest-label" for="adventure">
                                                <i class="fas fa-mountain"></i>
                                                <span>Adventure</span>
                                            </label>
                                        </div>
                                        <div class="interest-item">
                                            <input class="interest-checkbox" type="checkbox" id="culture" name="interests[]" value="culture" {{ in_array('culture', $user->travel_interests) ? 'checked' : '' }}>
                                            <label class="interest-label" for="culture">
                                                <i class="fas fa-landmark"></i>
                                                <span>Culture</span>
                                            </label>
                                        </div>
                                        <div class="interest-item">
                                            <input class="interest-checkbox" type="checkbox" id="relaxation" name="interests[]" value="relaxation" {{ in_array('relaxation', $user->travel_interests) ? 'checked' : '' }}>
                                            <label class="interest-label" for="relaxation">
                                                <i class="fas fa-umbrella-beach"></i>
                                                <span>Relaxation</span>
                                            </label>
                                        </div>
                                        <div class="interest-item">
                                            <input class="interest-checkbox" type="checkbox" id="food" name="interests[]" value="food" {{ in_array('food', $user->travel_interests) ? 'checked' : '' }}>
                                            <label class="interest-label" for="food">
                                                <i class="fas fa-utensils"></i>
                                                <span>Food & Dining</span>
                                            </label>
                                        </div>
                                        <div class="interest-item">
                                            <input class="interest-checkbox" type="checkbox" id="nature" name="interests[]" value="nature" {{ in_array('nature', $user->travel_interests) ? 'checked' : '' }}>
                                            <label class="interest-label" for="nature">
                                                <i class="fas fa-tree"></i>
                                                <span>Nature</span>
                                            </label>
                                        </div>
                                        <div class="interest-item">
                                            <input class="interest-checkbox" type="checkbox" id="shopping" name="interests[]" value="shopping" {{ in_array('shopping', $user->travel_interests) ? 'checked' : '' }}>
                                            <label class="interest-label" for="shopping">
                                                <i class="fas fa-shopping-bag"></i>
                                                <span>Shopping</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="submit-btn info">
                                        <i class="fas fa-save"></i>
                                        <span>Save Preferences</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="form-card danger">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h2>Delete Account</h2>
                        </div>
                        <div class="card-body">
                            <div class="danger-warning">
                                <i class="fas fa-exclamation-circle"></i>
                                <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                            </div>
                            
                            <form method="post" action="{{ route('profile.destroy') }}" class="profile-form">
                                @csrf
                                @method('delete')

                                <div class="form-group">
                                    <label for="password_delete" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        Password
                                    </label>
                                    <input type="password" 
                                           class="form-input @error('password') is-invalid @enderror" 
                                           id="password_delete" 
                                           name="password" 
                                           placeholder="Enter your password to confirm">
                                    @error('password')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="submit-btn danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete Account</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
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

                    <!-- Quick Stats -->
                    <div class="stats-card">
                        <div class="card-header">
                            <div class="header-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h2>Your Travel Stats</h2>
                        </div>
                        <div class="card-body">
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $user->search_count }}</div>
                                    <div class="stat-label">Searches</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">{{ $user->favorites_count }}</div>
                                    <div class="stat-label">Favorites</div>
                                </div>
                            </div>
                        </div>
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
                                <a href="{{ route('explore') }}" class="action-item">
                                    <i class="fas fa-globe"></i>
                                    <span>Explore Destinations</span>
                                </a>
                                <a href="{{ route('destination.suggest') }}" class="action-item">
                                    <i class="fas fa-search"></i>
                                    <span>Find Destination</span>
                                </a>
                                <a href="{{ route('dashboard') }}" class="action-item">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.profile-edit-container {
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
}

.profile-avatar {
    font-size: 6rem;
    color: rgba(255,255,255,0.3);
}

.profile-content {
    padding: 2rem 0 4rem;
}

.alert-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.alert-modern.success {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid rgba(40, 167, 69, 0.2);
    color: #28a745;
}

.alert-modern i {
    font-size: 1.2rem;
}

.form-card, .summary-card, .stats-card, .actions-card {
    background: rgba(255,255,255,0.95);
    border-radius: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    overflow: hidden;
}

.form-card.danger {
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.form-card.danger .card-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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

.profile-form {
    max-width: 100%;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
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

.form-error {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.interests-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.interest-item {
    position: relative;
}

.interest-checkbox {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.interest-label {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 1.5rem;
    background: rgba(102, 126, 234, 0.1);
    border: 2px solid rgba(102, 126, 234, 0.2);
    border-radius: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #333;
}

.interest-label:hover {
    background: rgba(102, 126, 234, 0.2);
    border-color: #667eea;
}

.interest-checkbox:checked + .interest-label {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
}

.interest-label i {
    font-size: 1.2rem;
}

.form-actions {
    text-align: right;
    margin-top: 2rem;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border: none;
    border-radius: 2rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.submit-btn.primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.submit-btn.warning {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    color: white;
}

.submit-btn.info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
}

.submit-btn.danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.danger-warning {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid rgba(220, 53, 69, 0.2);
    border-radius: 1rem;
    margin-bottom: 1.5rem;
}

.danger-warning i {
    color: #dc3545;
    font-size: 1.5rem;
    margin-top: 0.2rem;
}

.danger-warning p {
    color: #dc3545;
    margin: 0;
    line-height: 1.5;
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

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 1rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 0.3rem;
}

.stat-label {
    font-size: 0.9rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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

@media (max-width: 768px) {
    .profile-title {
        font-size: 2.5rem;
    }
    
    .profile-avatar {
        font-size: 4rem;
        margin-top: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .interests-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        text-align: center;
    }
    
    .submit-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
