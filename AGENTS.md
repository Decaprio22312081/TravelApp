# AGENTS.md

## Project

TravelKu — Laravel 13.8 travel/rental mobil app for Bandar Lampung, Indonesia. All UI text is Indonesian (written directly in Blade templates, not via translation files).

## Quick Commands

- **Full setup:** `composer setup`
- **Dev server:** `composer dev` (runs artisan serve + queue + pail + vite concurrently)
- **Run tests:** `composer test` (clears config cache then `php artisan test`)
- **Single test:** `php artisan test --filter=TestClassName`
- **Lint:** `./vendor/bin/pint`
- **Build frontend:** `npm run build`

## Stack

- PHP 8.3, Laravel 13.8, SQLite (dev + testing), Blade templates (no Livewire/Inertia)
- Tailwind CSS v4, Vite 8 with `@tailwindcss/vite` plugin, plus **CDN Tailwind** on auth pages (login/register/forgot-password)
- Alpine.js loaded via CDN (`alpinejs@3.x.x`) — no npm package
- Material Symbols icons via Google Fonts (`Material+Symbols+Outlined`)
- Maps: Google Maps embed (`destinasi/show`), Leaflet/OpenStreetMap (`about`)
- `.npmrc` sets `ignore-scripts=true`

## Architecture

Single Laravel project. Non-default drivers (all `database`): `SESSION_DRIVER`, `QUEUE_CONNECTION`, `CACHE_STORE`.

| Path | Notes |
|---|---|
| `app/Models/` | 10 models: Destinasi, Mobil, Pemesanan, Pembayaran, Ulasan, Mitra, BankAccount, Setting, PromoBanner, User |
| `app/Http/Controllers/` | Public controllers; `Admin/` subdir for admin panel |
| `app/Http/Middleware/AdminMiddleware.php` | Checks `User::isAdmin()` (`role === 'admin'`), returns 403 |
| `routes/web.php` | All routes (no API routes); admin prefix `/admin` with `auth` + `admin` middleware |
| `resources/views/` | Blade views per feature: admin/, auth/, dashboard/, destinasi/, mobil/, etc. |
| `database/migrations/` | Prefixed `2025_01_01_*` |
| `database/seeders/DatabaseSeeder.php` | Demo data including admin + user |

## Conventions

- **Models:** 9 of 10 use traditional `protected $fillable` arrays. Only `User.php` uses PHP 8 `#[Fillable]` / `#[Hidden]` attributes.
- **Indonesian naming:** `pemesanan` (order), `pembayaran` (payment), `destinasi` (destination), `ulasan` (review), `mobil` (car), `mitra` (partner)
- **Route names:** dot notation (`pemesanan.create`, `admin.dashboard`)
- **File uploads:** `public` disk, paths `users/foto`, `users/ktp`
- **Auth routes** (guest): `/login`, `/register`, `/forgot-password`
- **Authenticated routes** (auth): `/dashboard`, `/profile`, `/pesan`, `/riwayat`, `/pembayaran/*`, `/ulasan/*`

## Demo Credentials (from DatabaseSeeder)

| Role | Email | Password |
|---|---|---|
| Admin | admin@travelku.com | admin123 |
| User | user@travelku.com | user123 |

## Testing

- PHPUnit 12.5, in-memory SQLite (`DB_DATABASE=:memory:` in `phpunit.xml`), config cache cleared before run
- Suites: `Unit` and `Feature` (only default ExampleTest stubs exist — add tests as needed)
- No external services required

## Gotchas

- `composer dev` requires Node.js (uses `npx concurrently`)
