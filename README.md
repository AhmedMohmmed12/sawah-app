# Sawah

Sawah (سوّاح, "travellers") is a trip planner for people paying in Saudi riyals. You give it a daily budget, the weather you want and the kind of trip, and it shows which countries fit, with hotels and things to do in each.

Live site: https://sawah.habani.site

It covers 22 countries, 66 hotels and 88 attractions. Budgets are mid-range estimates per person per day in SAR (hotel, food, local transport and entry fees, without flights). Hotel prices are typical starting rates and change with the season. Exchange rates update once a day.

## What's in it

- **Destinations, Hotels, Things to do:** public pages anyone can browse and filter.
- **Country pages:** daily budget, today's exchange rate, best months, a numbered list of things to do, hotels, and countries with a similar budget.
- **Trip planner** (signed-in travellers): matches countries whose budget range overlaps yours and whose climate fits, then ranks them by how many things to do suit the trip type. Each result says why it matched.
- **My trips:** saved preferences (budget, weather, interests) pre-fill the planner and suggest countries.
- **Admin panel** (`/admin`, manager role): manage countries, hotels and things to do, with search, filters and photo uploads.

## Stack

- Laravel 12, PHP 8.2+, MySQL
- Blade views with a small hand-written CSS design system in `resources/css` (no CSS framework)
- Alpine.js for menus, card rows and confirm dialogs
- Vite for building assets

## Setup

```bash
git clone https://github.com/AhmedMohmmed12/sawah-app.git
cd sawah-app
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Set your database details in `.env`, then:

```bash
php artisan migrate
php artisan db:seed
php artisan rates:update
npm run build
php artisan storage:link
php artisan serve
```

`db:seed` loads the countries, hotels and attractions and creates a manager account (`manager@sawah.com`, password `password`). **Change that password before deploying**, or create your own manager and delete the seeded one.

The seeders can be run again safely. They update rows by name instead of duplicating them, and they leave anything added through the admin panel alone.

For development with hot reload, run `npm run dev` alongside `php artisan serve`.

## Data and photos

The seed data lives in `database/seeders/data/destinations.php`. Each country lists its currency, capital, region, climate, best months, daily budget, four things to do and three hotels.

Photos are freely licensed images from Wikimedia Commons, stored in `public/images`. Their authors and licences are recorded in `database/seeders/data/image-credits.php`, shown under each photo, and listed on `/photo-credits`.

To add or change a photo, edit the entry's `photo` value (a Wikipedia article title, a search phrase, or an exact `File:...` name on Commons) and run:

```bash
php artisan sawah:fetch-images
php artisan db:seed
```

The command only downloads entries whose `photo` changed. Pass `--only=hotels/the-savoy` to fetch a single entry, or `--force` to fetch everything again. Check new photos by eye: search results are sometimes the wrong place.

## Exchange rates

`exchange_rate_to_sar` stores how many riyals one unit of the local currency is worth. `php artisan rates:update` fetches current rates from [open.er-api.com](https://open.er-api.com) (free, no API key) and is scheduled daily in `routes/console.php`.

If your host has no cron job for `php artisan schedule:run`, the home and destinations pages also refresh the rates when they are more than a day old. A failed refresh is logged and the stored rates are kept.

## Deploying an update

After pulling a new version on the server:

```bash
php artisan migrate --force
php artisan db:seed --force
npm ci && npm run build
php artisan optimize
```

The Docker image builds the assets but does not run migrations or seeders, so run those two commands in the container after deploying.

## Tests

```bash
php artisan test
```

The feature tests seed the real data into an in-memory SQLite database and check the public pages, the trip planner matching and access rules.
