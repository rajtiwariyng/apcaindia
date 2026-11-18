# CLAUDE.md — APCA India

**Read `docs/README.md` and `docs/STATUS.md` first** — they record what is built, what is pending, what is static vs dynamic, and known bugs. Update the matching doc and `docs/CHANGELOG.md` with every change; never assume — mark anything unverified as such.

Laravel 12 (PHP 8.2+) marketing/CMS site for APCA (culinary academy). It is a rebuild of a legacy Laravel 7 app and uses the **same legacy table schema** (`tbl_*`, `courses`, `users`, ...). See `DEPLOYMENT.md` for the production cutover plan.

## Run locally (XAMPP, Windows)

```bash
php artisan serve --port=8000      # http://localhost:8000
php artisan config:clear           # after editing .env
php artisan test                   # PHPUnit (tests/Feature/{Admin,Front})
```

- DB: local MySQL (XAMPP) database `apcaindia`, user `root`, no password. Seed data lives in `apcaindia.sql` (project root).
- Re-import: `tail -n +2 apcaindia.sql | /c/xampp/mysql/bin/mysql -uroot apcaindia` (the first line is a MariaDB-only comment that MySQL rejects).
- The dump has **no `migrations` table**; do not run `php artisan migrate` against it. Legacy table definitions are in `database/migrations/legacy/` for reference only.
- `.env` is local-only. Never commit real production credentials.
- Frontend: there is no Vite source (`resources/css`, `resources/js` don't exist). Views use static assets in `public/assets` and `public/admin_assets`. `npm run build` fails for that reason and isn't needed.

## Layout

| Path | Purpose |
|---|---|
| `routes/web.php` | Public routes (URLs preserved from legacy — don't rename) |
| `routes/admin.php` | Admin routes, loaded with the `web` middleware in `bootstrap/app.php` |
| `app/Http/Controllers/Front/` | Public pages (Home, Courses, Blog, AboutUs, Contact, ...) |
| `app/Http/Controllers/Admin/` | CMS modules, one controller per content type |
| `app/Http/Controllers/Admin/Concerns/AdminCrudActions.php` | Shared `changeStatus` / `deleteData` for admin modules (needs `$model`, `$table`) |
| `app/Http/Middleware/AuthenticateAdmin.php` | Alias `auth.admin`; checks session key `sessionadmin`, else redirects to `/admin-login` |
| `app/Models/` | Eloquent models mapped to legacy tables |
| `app/helpers.php` | Global helpers ported from legacy (e.g. `random_unique_id()`, `record_page_view()`) |
| `resources/views/{home,courses,blog...,admin}` | Blade views; admin views use the `Admin::` namespace |
| `tests/Feature/` | Admin and front-end feature tests |

## Conventions and gotchas

- Rows are identified by a `uniqueid` column (not just the auto-increment id); status toggles and deletes go through `AdminCrudActions`.
- Admin login checks the `users` table with **md5** (legacy, insecure). Do not "fix" it ad hoc: changing hashing needs a password migration. Flag it, don't silently change it.
- `CategoriesController` queries a table that isn't in the local dump (`gallary_category` etc. may differ) — check its controller note before debugging 500s there.
- Preserve legacy behavior when porting: URLs, session keys, and response shapes are relied on by existing JS/views.
- Uploads go to `storage/app/public` (run `php artisan storage:link` once; already done locally).
- Keep changes minimal and in the style of the surrounding code; run `php artisan test` before finishing.

## Don'ts

- Don't run destructive DB commands (`migrate:fresh`, `db:wipe`, dropping tables) without explicit confirmation.
- Don't edit `.env.example` secrets or commit `.env`, `apcaindia.sql` changes, or the `*.upload.tmp` zip in the root.
- Don't touch `vendor/` or `public/assets` vendor bundles.
