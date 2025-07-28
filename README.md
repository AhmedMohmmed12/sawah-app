# Sawah - Tourism Made Easy and Smart

A modern Laravel-based tourism application that provides personalized destination recommendations, budget planning, and travel insights with comprehensive admin management capabilities.

## Features

### 🎯 **User Features**
- 🗺️ **Smart Destination Recommendations** - Get personalized suggestions based on preferences
- 💰 **Budget Planning** - Plan trips with accurate budget estimates and currency rates
- 🏨 **Hotel & Accommodation Discovery** - Find the best places to stay
- 🎯 **Attraction Explorer** - Discover popular attractions and activities
- 👤 **User Profiles** - Save travel preferences and track search history
- 🌍 **Country Explorer** - Browse destinations with detailed information
- 📱 **Responsive Design** - Works perfectly on desktop and mobile devices

### 🔧 **Admin Features**
- 👨‍💼 **Admin Dashboard** - Comprehensive overview of platform statistics
- 🏳️ **Country Management** - Add, edit, and manage countries with images
- 🏛️ **Attraction Management** - Manage tourist attractions and points of interest
- 🏨 **Hotel Management** - Manage hotel listings with pricing and ratings
- 👥 **User Management** - Monitor user activity and platform usage
- 🔐 **Role-Based Access Control** - Secure admin-only functionality

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 8.1
- **Composer** >= 2.0
- **Node.js** >= 16.0 (for frontend assets)
- **MySQL** >= 8.0
- **Web Server** (Apache/Nginx) or **Laravel Sail** (Docker)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/sawah-app.git
cd sawah-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Setup

Copy the environment file and configure your database:

```bash
cp .env.example .env
```

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sawah_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Seed the Database

```bash
php artisan db:seed
```

This will populate the database with:
- Sample countries with travel information
- Popular destinations and attractions
- Hotel listings with pricing
- Default admin user account

### 8. Build Frontend Assets

```bash
npm run build
```

### 9. Set Up Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link for file uploads and image storage.

### 10. Create Storage Directories

```bash
mkdir -p storage/app/public/countries
mkdir -p storage/app/public/attractions
mkdir -p storage/app/public/hotels
```

## Running the Application

### Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`


## File Structure

```
sawah-app/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # Admin controllers
│   │   ├── Auth/            # Authentication controllers
│   │   └── ...              # Other controllers
│   ├── Models/              # Eloquent models
│   ├── Helpers/             # Helper classes (ImageHelper)
│   └── Providers/           # Service providers
├── resources/views/
│   ├── admin/               # Admin views
│   ├── auth/                # Authentication views
│   ├── profile/             # User profile views
│   └── ...                  # Other views
├── routes/
│   ├── web.php              # Web routes
│   └── auth.php             # Authentication routes
└── storage/
    └── app/public/          # File uploads
        ├── countries/       # Country images
        ├── attractions/     # Attraction images
        └── hotels/          # Hotel images
```

## Key Features Implementation

### Role-Based Access Control
- **User Role**: Regular users with travel features
- **Manager Role**: Administrators with full management capabilities
- **Middleware Protection**: Secure routes based on user roles

### Image Management
- **External URLs**: Support for Unsplash and other external image sources
- **Local Storage**: File upload capability for local images
- **Image Helper**: Smart handling of both external and local images
- **Storage Links**: Proper file serving configuration

### Admin Interface
- **Dedicated Layout**: Admin-specific design and navigation
- **CRUD Operations**: Full create, read, update, delete functionality
- **Dashboard Analytics**: Platform statistics and monitoring
- **User Management**: Admin profile and account management

## Customization

### Adding New Countries

1. Access the admin panel at `/admin/countries`
2. Click "Add New Country"
3. Fill in country details and upload an image
4. Save the country

### Modifying the Design

The application uses:
- **Bootstrap 5** for responsive layout
- **Font Awesome** for icons
- Custom CSS for styling

### Environment Variables

Key environment variables you can customize:

```env
APP_NAME="Sawah"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sawah_app
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Server Requirements

- PHP >= 8.1
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Troubleshooting

### Common Issues

1. **Images not displaying**:
   - Ensure storage link is created: `php artisan storage:link`
   - Check file permissions on storage directory
   - Verify image URLs in database

2. **Admin access denied**:
   - Check user role in database
   - Ensure middleware is properly configured
   - Verify route protection

3. **Database connection issues**:
   - Check `.env` file configuration
   - Ensure database server is running
   - Verify database credentials
