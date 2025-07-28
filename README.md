# Sawah - Tourism Made Easy and Smart

A modern Laravel-based tourism application that provides personalized destination recommendations, budget planning, and travel insights.

## Features

- 🗺️ **Smart Destination Recommendations** - Get personalized suggestions based on preferences
- 💰 **Budget Planning** - Plan trips with accurate budget estimates and currency rates
- 🏨 **Hotel & Accommodation Discovery** - Find the best places to stay
- 🎯 **Attraction Explorer** - Discover popular attractions and activities
- 👤 **User Profiles** - Save travel preferences and track search history
- 🌍 **Country Explorer** - Browse destinations with detailed information
- 📱 **Responsive Design** - Works perfectly on desktop and mobile devices

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 8.1
- **Composer** >= 2.0
- **Node.js** >= 16.0 (for frontend assets)
- **MySQL** >= 8.0 or **PostgreSQL** >= 13.0
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

This will populate the database with sample countries, destinations, hotels, and attractions.

### 8. Build Frontend Assets

```bash
npm run build
```

### 9. Set Up Storage Link

```bash
php artisan storage:link
```

## Running the Application

php artisan serve


The application will be available at `http://localhost:8000`



## Default Data

After running the seeders, you'll have:

- Sample countries with travel information
- Popular destinations and attractions
- Hotel listings with pricing
- User accounts for testing



### Adding New Countries

1. Add country data to the database
2. Include country images in `public/storage/countries/`
3. Update the `CountrySeeder` if needed

### Modifying the Design

The application uses:
- **Bootstrap 5** for responsive layout
- **Tailwind CSS** for utility classes
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


### Server Requirements

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


