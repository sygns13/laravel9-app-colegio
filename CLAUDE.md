# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this app is

"APP de Cotizaciones Yamaha" — a Laravel 11 internal tool for generating Yamaha motorcycle
price quotations (cotizaciones) and sales (ventas), with PDF/Excel export. The codebase, comments,
DB columns, and route names are all in **Spanish**; keep new code consistent with that.

The repo also contains a large, mostly-dormant **school-management system** (alumnos, matrículas,
docentes, asistencias, notas) carried over from the base template this project was forked from. It
lives under `app/Http/Controllers/Admin/`, `resources/views/{admin,alumno,docente,apoderado}/`, and
many `app/Models/*`. The active product is the cotización/ventas side under
`app/Http/Controllers/{cotizacion,ventas}/` and `resources/views/yamaha/`. Don't assume the school
modules are wired up or maintained.

## Commands

This is an XAMPP/Windows environment (`C:\xampp\htdocs\appcotizacionyamaha`). PHP, Composer, Node are run from the shell.

```powershell
composer install
npm install
php artisan serve            # or use the cotizacionyamaha.test vhost
npm run watch                # Laravel Mix dev build + watch (webpack.mix.js)
npm run prod                 # production asset build
php artisan migrate          # NOTE: see "Database" — migrations DO NOT create the domain schema
vendor\bin\pint              # code style (Laravel Pint, config in .styleci.yml mirrors it)
php artisan test             # PHPUnit
php artisan test --filter=SomeTest          # single test
vendor\bin\phpunit --filter testMethodName  # single test method
```

Asset pipeline is **Laravel Mix (webpack)**, not Vite — edit `webpack.mix.js`, build with the npm
scripts above. Tailwind config is `tailwind.config.js`.

## Database — important

`php artisan migrate` only builds the Laravel/Jetstream scaffolding (users, teams, sessions, jobs,
posts). The **real domain schema is NOT in `database/migrations/`** — it lives as raw SQL dumps in
`bd/` (`backup_07_05_2026.sql` is the most recent; `script_v1.sql`, `test1.sql`, and the MySQL
Workbench model `modelado.mwb` are older). To set up a working DB, import the latest `bd/*.sql` into
the MySQL database named in `.env` (`bd_yamaha_cotizations`). When you change a domain table, update
the SQL dump / schema by hand — there is no migration to edit.

## Architecture & conventions

**Auth & roles.** Jetstream + Fortify + Sanctum + Livewire + Teams. Authorization is by an integer
`tipo_user_id` on `users`, exposed as Gates in `app/Providers/AuthServiceProvider.php`:
`1 = admin`, `2 = cotizador`, `3 = ventas`. Controllers branch on `Gate::allows('admin')`. There is
no role table — the mapping is hardcoded in the provider.

**Routing.** Almost everything lives in `routes/admin.php`, which `RouteServiceProvider` mounts under
the **`/admin` prefix** behind `auth:sanctum` + Jetstream session + `verified`. `routes/web.php` only
redirects `/` to login and serves `/dashboard`. So a route defined as `/cotizaciones` is reached at
`/admin/cotizaciones`.

**Controller naming convention (followed throughout):**
- `index1`, `index2`, `index3`… are page actions that **return Blade views** (e.g.
  `view('yamaha.cotizacion.index')`). The number distinguishes different screens served by one
  controller.
- Resource controllers are registered with a **`re` prefix** route (`Route::resource('/recotizacion', CotizacionController::class)`, `/repersonal`, `/reventas`, …). Their `store/update/destroy` and
  `index` (plain `index(Request)`) methods are AJAX endpoints that **return JSON**, not views.
- JSON responses use a consistent shape: `{ result: '1'|'0', msj, selector }` where `selector` is the
  id of the form field to focus on validation error. New endpoints should match this.

**Soft-delete pattern.** The app does **not** use Laravel `SoftDeletes`. Every domain table carries two
integer flags: `activo` (1 active / 0 inactive) and `borrado` (0 live / 1 deleted). Always filter
queries with `->where('borrado', 0)` (and usually `->where('activo', 1)`), and "delete" by setting
`borrado = 1`. New tables and queries must follow this.

**Data access.** Models lean heavily on the raw **query builder** (`DB::table(...)->join(...)`) rather
than Eloquent relationships. List screens are powered by static `GetData(Request $request)` /
`GetDataExport(Request $request)` methods on the model (see `app/Models/Cotizacion.php`) that build a
filtered join query and return `['pagination' => [...], 'registros' => $paginator]` with a custom
pagination array. Facade aliases are imported directly (`use DB; use Auth; use PDF; use Validator; use Storage;`).

**Cotización domain flow.** `MaestroModelo` is the catalog (model/year/color/price in USD, plus all
spec and image-URL fields). Creating a `Cotizacion` **snapshots** the chosen `MaestroModelo` into a
`DataCotizacion` row (so later catalog edits don't change historical quotes), then materializes
included items (warranty + benefits) into `Includes` rows from `MaestroBeneficio` / `Garantia` /
`Beneficio`. `Config::first()` holds the single `tipo_cambio` (USD→PEN exchange rate) applied to
compute `precio_final_pen`. `Personal` is the salesperson record linked to a `user_id`; `Cliente` is
the customer (created or updated inline during `store`). Quote numbers are `year-NNNNNNNN`
(8-digit zero-padded, reset per year).

**PDF & Excel.** PDFs via `barryvdh/laravel-dompdf` (`PDF` facade), generated in
`app/Http/Controllers/Admin/ReportPDFController.php` and the cotización controllers; templates live in
`resources/views/reportspdf/`. Excel via `maatwebsite/excel` with export classes in `app/Exports/`.

**UI.** AdminLTE (`jeroennoten/laravel-adminlte`) provides the admin shell; the **sidebar menu is
static config in `config/adminlte.php`**, not built in code. Blade views use AlpineJS and CKEditor 5
(loaded as npm deps). Per-screen JS/AJAX typically lives inline in the Blade view or in `public/`.
