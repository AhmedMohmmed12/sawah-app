<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sawah') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            .auth-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .logo-container {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .logo-container a {
                text-decoration: none;
                color: white;
                font-size: 2rem;
                font-weight: bold;
            }
            
            .logo-container i {
                color: #ff6b35;
                margin-right: 0.5rem;
            }
            
            .form-control {
                border-radius: 10px;
                border: 2px solid #e9ecef;
                padding: 12px 15px;
                transition: all 0.3s ease;
            }
            
            .form-control:focus {
                border-color: #ff6b35;
                box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
            }
            
            .form-label {
                font-weight: 600;
                color: #333;
                margin-bottom: 0.5rem;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #ff6b35 0%, #e55a2d 100%);
                border: none;
                border-radius: 10px;
                padding: 12px 30px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
                background: linear-gradient(135deg, #e55a2d 0%, #d44a1d 100%);
            }
            
            .btn-link {
                color: #ff6b35;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.3s ease;
            }
            
            .btn-link:hover {
                color: #e55a2d;
            }
            
            .form-check-input:checked {
                background-color: #ff6b35;
                border-color: #ff6b35;
            }
            
            .alert {
                border-radius: 10px;
                border: none;
            }
            
            .alert-success {
                background-color: rgba(40, 167, 69, 0.1);
                color: #155724;
            }
            
            .alert-danger {
                background-color: rgba(220, 53, 69, 0.1);
                color: #721c24;
            }
            
            .text-muted {
                color: #6c757d !important;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
            <div class="row w-100 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="logo-container">
                        <a href="/">
                            <i class="fas fa-map-marked-alt"></i>Sawah
                        </a>
                    </div>
                    
                    <div class="auth-container p-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
