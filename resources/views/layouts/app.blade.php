<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sawah - Tourism Made Easy and Smart')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: white !important;
        }
        .navbar-nav .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .navbar-nav .dropdown-item:hover {
            background-color: #ff6b35;
            color: white;
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200');
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .btn-orange {
            background-color: #ff6b35;
            border-color: #ff6b35;
            color: white;
        }
        .btn-orange:hover {
            background-color: #e55a2d;
            border-color: #e55a2d;
            color: white;
        }
        .country-card {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .attraction-img {
            height: 200px;
            object-fit: cover;
        }
        .map-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        main {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
        footer {
            margin-top: 0 !important;
        }
        body {
            margin-bottom: 0 !important;
        }
        .container-fluid, .container {
            margin-bottom: 0 !important;
        }
        .row {
            margin-bottom: 0 !important;
        }
        .col, .col-md-6, .col-md-12 {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #ff6b35 0%, #e55a2d 100%);">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ route('home') }}">
                <i class="fas fa-map-marked-alt me-2"></i>Sawah
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('explore') }}">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('destination.suggest') }}">Suggest Destination</a>
                        </li>
                        @if(auth()->user()->isManager())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                @if(auth()->user()->isManager())
                                    <span class="badge bg-warning text-dark ms-1">Manager</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.overview') }}">Profile Overview</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                                
                                @if(auth()->user()->isManager())
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.countries.index') }}">Manage Countries</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.attractions.index') }}">Manage Attractions</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.hotels.index') }}">Manage Hotels</a></li>
                                @endif
                                
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="navbar navbar-expand-lg navbar-dark py-2" style="background: linear-gradient(135deg, #ff6b35 0%, #e55a2d 100%);">
        <div class="container">
            <div class="navbar-brand text-white">
                <i class="fas fa-map-marked-alt me-2"></i>Sawah
            </div>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-white-50">&copy; 2024 Sawah. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
