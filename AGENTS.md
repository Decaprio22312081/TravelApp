# AGENTS.md

## Project

TravelKu — Laravel 13 (13.16.1 installed, `^13.8`) travel/rental mobil app for Bandar Lampung, Indonesia. All UI text is Indonesian (written directly in Blade templates, not via translation files). Public branding is **"CV. Afia Jaya Abadi"** (navbar, page headers, page titles) though code/config still says "TravelKu".

## Quick Commands

- **Full setup:** `composer setup` (composer install + copies `.env.example`→`.env` + key:generate + migrate + `npm run build`)
- **Dev server:** `composer dev` (runs artisan serve + queue + pail + vite concurrently)
- **Run tests:** `composer test` (clears config cache then `php artisan test`)
- **Single test:** `php artisan test --filter=TestClassName`
- **Lint:** `./vendor/bin/pint`
- **Build frontend:** `npm run build`

## Stack

- PHP ^8.3 (runs on 8.4), Laravel ^13.8 (13.16.1 installed), SQLite (dev + testing), Blade templates (no Livewire/Inertia, no API routes — `routes/web.php` + `routes/console.php` only)
- **All styling is Tailwind v4 via CDN** (`cdn.tailwindcss.com` with `forms,container-queries` plugins) + an inline `tailwind.config` theme block in each layout (custom `primary`/`secondary`/`surface` palette, `DM Sans` + `Fraunces` Google Fonts, custom radii, `!important` `.rounded-3xl/4xl` overrides). `@tailwindcss/vite` + `resources/css/app.css` are configured but **no view uses `@vite`** — `npm run build` output does not affect the UI.
- Font Awesome 6.5 on the **admin** layout; Material Symbols (Google Fonts) on all pages; Alpine.js via CDN (`alpinejs@3.x.x`) — no npm package
- Maps: Google Maps embed (`destinasi/show`), Leaflet/OpenStreetMap (`tentang-kami`)
- `.npmrc` sets `ignore-scripts=true`; `composer setup` runs `npm install --ignore-scripts`
- **File uploads:** `public` disk (`storage/app/public`), paths `users/foto`, `users/ktp`

## Architecture

Single Laravel project. Non-default drivers (all `database`): `SESSION_DRIVER`, `QUEUE_CONNECTION`, `CACHE_STORE`.

| Path | Notes |
|---|---|
| `app/Models/` | 11 models: Destinasi, Mobil, Paket, Pemesanan, Pembayaran, Ulasan, Mitra, BankAccount, Setting, PromoBanner, User |
| `app/Http/Controllers/` | Public controllers; `Admin/` subdir (11) incl. `LaporanController` (CSV export at `/admin/laporan/export`) and `PengaturanController` (settings, bank accounts, promo banners) |
| `app/Http/Middleware/AdminMiddleware.php` | Checks `User::isAdmin()` (`role === 'admin'`), returns 403 |
| `routes/web.php` | All routes; admin prefix `/admin` with `auth` + `admin` middleware |
| `resources/views/` | Blade views per feature; layouts `layouts/app.blade.php` and `admin/layouts/app.blade.php` |
| `database/migrations/` | Prefixed `2025_01_01_*` for app tables; `0001_01_01_*` for Laravel system tables |
| `database/seeders/DatabaseSeeder.php` | Demo data: admin + user + destinasi + mobil + mitra + bank accounts + settings |

## Conventions

- **Models:** 10 of 11 use `protected $fillable` arrays. Only `User.php` uses PHP 8 `#[Fillable]` / `#[Hidden]` attributes.
- **Indonesian naming:** `pemesanan` (order), `pembayaran` (payment), `destinasi` (destination), `ulasan` (review), `mobil` (car), `mitra` (partner)
- **Status enums (Indonesian, defined in migrations):** `pemesanan.status`: `menunggu_pembayaran`, `menunggu_verifikasi`, `dikonfirmasi`, `berjalan`, `selesai`, `ditolak`, `batal`; `pembayaran.status`: `menunggu_verifikasi`, `terverifikasi`, `ditolak`; `mobil.status`: `tersedia`, `disewa`, `maintenance`
- **Order flow:** user books via `/pesan` → uploads payment → admin verifies (`/admin/pembayaran/{id}/verifikasi`) → user reviews (`/ulasan/{pemesanan_id}`)
- **Paket pricing:** a paket booking charges `total_harga = $paket->harga` ONLY — vehicle + supir are included in the paket price (vehicle rental is NOT added). Sewa mobil mode charges `mobil.harga_per_hari × jumlah_hari`. See `PemesananController::store` — don't "fix" the paket total back to `paket + mobil`.
- **Paket-mode vehicle picker only lists HiAce:** `$mobilJson` (drives the paket-mode kendaraan `<select>`) is filtered to mobils whose name contains `haice` (case-insensitive). `$mobils` (sewa mobil mode) still lists all `tersedia` cars. Don't remove that filter.
- **Branding:** navbar/headers/titles use "CV. Afia Jaya Abadi". `auth/login` and `auth/register` are **standalone full-HTML pages** with their own navbar copies (they do NOT `@extends('layouts.app')`), so branding/button text changes must be mirrored in `layouts/app.blade.php` + `auth/login.blade.php` + `auth/register.blade.php`. `auth/forgot-password` extends the layout.
- `AuthController::register` passes `$mobils` (tersedia cars) to `auth/register` for the "Armada Pilihan" section.
- **Site text (contact, social, `tentang_kami`, `alamat`) lives in the `settings` table** (seeded in DatabaseSeeder, rendered via `Setting::keyBy('key')`) — not hardcoded in views (fallbacks in Blade exist but are only used if the row is missing). Address is currently "Jl. Lintas Sumatera No.162, Bumisari, Kec. Natar, Kabupaten Lampung Selatan".
- **Route names:** dot notation (`pemesanan.create`, `admin.dashboard`)
- **Auth auto-redirect:** Admin → `/admin/dashboard`, user → `/dashboard` (see `AuthController::authenticate`)
- **Guest routes:** `/login`, `/register`, `/forgot-password`
- **Auth routes:** `/dashboard`, `/profile`, `/pesan`, `/riwayat`, `/pembayaran/*`, `/ulasan/*`

## Demo Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@travelku.com | admin123 |
| User | user@travelku.com | user123 |

## Testing

- PHPUnit 12.5, in-memory SQLite (`DB_DATABASE=:memory:` in `phpunit.xml`), config cache cleared before run
- Suites: `Unit` and `Feature` (only default ExampleTest stubs exist)
- No external services required

## Gotchas

- `composer setup` does NOT run `storage:link` — run `php artisan storage:link` after setup for file uploads
- `.env` is not in the repo; `composer setup` copies `.env.example` (`APP_LOCALE=en` but all UI is Indonesian — no translation system)
- `database/database.sqlite` is gitignored and not committed; `php artisan migrate` auto-creates it (Laravel SQLite connector)
- `composer dev` requires Node.js (uses `npx concurrently`)

## Blade Gotchas (verified parse errors)

- **Never pass an inline array literal to `@json()`.** Laravel's `@json` directive compiles via `explode(',')` on the expression, so any comma inside the expression (e.g. `@json($x->map(fn($p) => ['a' => $p->a, ...]))`) silently mangles the compiled PHP ("Unclosed '[' ... does not match ')'"). Always pre-compute the array in the controller and pass `@json($variable)`. (Broke `GET /pesan` once — `pemesanan/create.blade.php` now uses `$paketJson`/`$mobilJson` from the controller.)
- **Never nest `@php ... @endphp` inside another `@php` block.** Blade's `@php(.*?)@endphp` regex is non-greedy and matches first-open to first-close, leaving a literal `@php` in the compiled PHP ("unexpected variable ..."). Use one flat `@php` block. (Broke `GET /pesanan/{id}` once — `pemesanan/show.blade.php` now uses a single flat block.)
- **Schema drift:** if you get "no such column" on a dev query, the local `database.sqlite` is out of sync with the (edited) migration files — some migrations were rewritten after being run and an old migration record can linger. Fix: `php artisan migrate:fresh --seed` (wipes local data).
