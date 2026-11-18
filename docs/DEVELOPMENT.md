# Development (local, Windows + XAMPP) — verified

## Run
```bash
php artisan serve --port=8000        # http://localhost:8000   (keep the terminal/process running)
php artisan config:clear             # after editing .env
php artisan view:clear               # after editing Blade views (compiled views are cached)
```
MySQL must be running (XAMPP). If it is not: `C:\xampp\mysql\bin\mysqld.exe --defaults-file=C:\xampp\mysql\bin\my.ini --standalone`.

## Local setup facts
- `.env` (local only, never commit): `DB_DATABASE=apcaindia`, user `root`, empty password, `APP_URL=http://localhost:8000`, `SESSION_DRIVER=file`, `CACHE_STORE=file`, `QUEUE_CONNECTION=sync`, `MAIL_MAILER=log`, `APP_DEBUG=true`.
- Re-import the base dump: `tail -n +2 apcaindia.sql | C:\xampp\mysql\bin\mysql -uroot apcaindia` (skip line 1: a MariaDB-only comment). `apcaindia.sql` is not tracked in git.
- Do **not** run `php artisan migrate` (legacy schema, no migrations table). Never run `migrate:fresh` / `db:wipe`.
- No frontend build: edit Blade/CSS/JS directly. (`npm install` was run, but `npm run build` fails because `resources/css/app.css` and `resources/js/app.js` do not exist — and nothing needs them.)
- Uploads: `public/assets/upload/<folder>/`. `php artisan storage:link` was run once.
- Logs: `storage/logs/laravel.log` (≈9 MB locally — safe to truncate).

## Scripts in `docs/` (one-off tools — read the header of each before running)
| Script | Purpose |
|---|---|
| `docs/import/import_wp_blog.php` | WordPress → `tbl_blog` import (dry run by default; `--commit`). Needs scratch DB `apca_blog_wp_scratch`. |
| `docs/import/backfill_wp_blog_images.php` | Fill `image` for imported posts (uses `curl.exe`; PHP curl has no CA bundle here). |
| `docs/import/gen_seo_metas_sql.py` → `apply_seo_metas.sql` | SEO sheet → `tbl_seo` (insert-only). |
| `docs/import/gen_centres_config.py` | Regenerates `config/centres.php` from a live-site extract (needs the extract JSON path as argument). |
| `docs/deploy/build_demo_package.php` | Builds the demo deploy package into `docs/deploy/out/`. |
Python on Windows cannot read Git-Bash `/tmp` paths — use real Windows paths when running these.

## Git
Remote `origin` = https://github.com/rajtiwariyng/apcaindia.git, branch `main`. Local git identity is set per-repo (author = committer); **never add Claude/AI co-author or attribution lines** to commits. Commit/push only on explicit request (see `AGENTS.md`).
Not in git: `.env`, `vendor/`, `node_modules/`, **all videos** (`*.mp4/*.mov/*.MOV/*.avi` — GitHub's 100 MB file limit), `docs/deploy/out/`. Hidden locally via `.git/info/exclude`: `apcaindia.sql`, `docs/apca_blog.sql`, `docs/backups/`, `*.upload.tmp`, `public/assets/upload/blog/` (imported blog images, 95 MB — not in git, rebuild with the fetch script or copy from the server).

## Conventions
Preserve legacy URLs, session keys and table names. Keep changes small and in the style of the surrounding code. Update docs + [CHANGELOG.md](CHANGELOG.md) with every change.
