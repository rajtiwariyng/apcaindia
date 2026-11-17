# APCA Chef — Laravel 12 deployment & cutover guide

This is the Laravel 12 rebuild of the legacy Laravel 7 site, pointed at the
**same `apca_india` database** (same tables, no migrations run on prod). The goal
of cutover is to replace the old app with this one **without data loss** and with
an **instant rollback** path.

> Nothing in this guide changes the database. The schema is shared and untouched.

---

## 0. Hard prerequisite: PHP version

**Laravel 12 requires PHP 8.2+.** Your production server currently runs
**PHP 8.0** (`.htaccess` → `AddHandler application/x-httpd-ea-php80`). You must
raise it before this app will run:

- cPanel → **MultiPHP Manager** → set the domain to **PHP 8.2 or 8.3**.
- Ensure these extensions are enabled (cPanel → *Select PHP Version → Extensions*):
  `pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, bcmath, fileinfo, curl`.
- Verify on the server: `php -v` shows 8.2/8.3.

The legacy L7 app does **not** run on 8.2+, so the old and new apps cannot share
one PHP setting. Use a staging subdomain (below) on 8.2 while the live domain
stays on 8.0 until the moment of cutover.

---

## 1. Build the release

On the server (or build locally and upload, excluding `vendor/`):

```bash
composer install --no-dev --optimize-autoloader
cp .env.example .env          # then edit .env (see §2)
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

All three caches are verified to build cleanly (no closure routes).

---

## 2. Configure `.env`

Copy from `.env.example` and set, at minimum:

| Key | Value |
|---|---|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false`  ← **must** be false in prod |
| `APP_KEY` | generated via `php artisan key:generate` |
| `APP_URL` | `https://apcachef.com` |
| `DB_DATABASE` | `apca_india` (unchanged) |
| `DB_USERNAME` / `DB_PASSWORD` | the production DB credentials |
| `SESSION_DRIVER` | `file` (matches legacy; no new tables) |
| `CACHE_STORE` | `file` |
| `QUEUE_CONNECTION` | `sync` |
| `MAIL_*` | real SMTP (contact form / newsletter) |

---

## 3. Document root (important on cPanel)

Laravel serves from the **`public/`** directory, but the legacy app served from
the project root. Pick one:

- **Preferred:** point the domain's document root at `.../apcachef-l12/public`
  (cPanel → *Domains* → edit the document root). Cleanest and most secure.
- **If you cannot change the doc root:** place the app folder **outside**
  `public_html`, then move the **contents** of `public/` into `public_html` and
  edit the two paths in `public_html/index.php`:
  ```php
  require __DIR__.'/../apcachef-l12/vendor/autoload.php';
  $app = require_once __DIR__.'/../apcachef-l12/bootstrap/app.php';
  ```
  Keep `storage/`, `bootstrap/`, `.env` etc. **outside** the web root.

---

## 4. Carry over the uploaded media (REQUIRED)

User-uploaded images/PDFs/videos live in **`public/assets/upload/`** and are
**git-ignored** (they are data, not code). Copy them from the live server's
legacy app into this app before cutover:

```
legacy:  <site>/public/assets/upload/   ->   apcachef-l12/public/assets/upload/
```

Subfolders in use: `blog, category, testimonial, gallery, photogallery,
placementpartners, supportingbrands, alumni, chefeducators, homeprogram,
homeslider, studentsection, bannervideo, pages, pdf, coursepage, coursemodule,
intprogram, intprogram_page`.

Ensure `storage/` and `bootstrap/cache/` are writable by the web user, and that
`public/assets/upload/` stays writable (admin uploads write there).

---

## 5. Cutover sequence (with instant rollback)

1. **Backup**: `mysqldump apca_india > backup.sql` + archive the legacy app dir
   and `public/assets/upload`.
2. **Stage**: deploy this app to a subdomain (e.g. `beta.apcachef.com`) on PHP
   8.2, `.env` pointing at a **copy** of `apca_india`. Smoke-test: log in, open
   each admin list, create/edit one record, submit the contact form, load the
   home page and a few public pages.
3. **Go live**: when satisfied, point the production document root at this app's
   `public/` (or do the `index.php` swap from §3), set `.env` to the **real**
   `apca_india`, and re-run the three `artisan *:cache` commands.
4. **Verify** on the live domain (see §7).
5. **Rollback (if needed)**: point the document root back at the legacy app.
   Because **no migrations were run** and the schema is unchanged, rollback is
   immediate and lossless.

---

## 6. md5 → bcrypt password migration (separate, opt-in)

Admin login currently authenticates against `users.password` using **`md5()`**
(ported verbatim so login keeps working). md5 is insecure. Recommended phased,
zero-lockout migration — **not yet applied; do on your go-ahead**:

1. On a successful **md5** login, transparently re-hash and store bcrypt:
   ```php
   // in Admin\AuthController::loginCheck(), after fetching $user
   if (Hash::check($password, $user->password)) {
       // already bcrypt — ok
   } elseif ($user->password === md5($password)) {
       DB::table('users')->where('id', $user->id)
         ->update(['password' => Hash::make($password)]); // upgrade in place
   } else {
       return /* invalid credentials */;
   }
   ```
2. After all active admins have logged in once (passwords upgraded), remove the
   md5 branch entirely.

This changes stored `users.password` values, so it needs your explicit approval
and a DB backup first.

---

## 7. Post-deploy checklist

- [ ] `https://apcachef.com/` loads (home page) with images.
- [ ] `/admin-login` → log in → dashboard counts render.
- [ ] One admin **create + edit + status-toggle + delete** works (writes verified).
- [ ] An image **upload** succeeds and the file appears under `public/assets/upload/`.
- [ ] Contact form submits (`/contact-us`) and a row lands in `contactus`.
- [ ] Newsletter subscribe works (confirm the form's POST URL — see §8).
- [ ] `APP_DEBUG=false`; hitting a bad URL shows a generic 404, not a stack trace.
- [ ] Apply `database/performance/recommended_indexes.sql` (reviewed) on the DB.

---

## 8. Known follow-ups before / around go-live

- **Newsletter POST URL**: the subscribe route is `/subscribe` here; confirm the
  front-end JS posts there (or tell us the real path) and adjust.
- **Category pages**: `Category` admin + `Categories` front query
  `tbl_course_category` / `tbl_course`, which are **absent locally**. Provide the
  production schema for those tables (and add migrations) before relying on them.
- **Orphan legacy features** (SEO admin, subscriber list, banner manager) were
  unrouted/dead in the legacy app and were not ported — tell us if any should be
  rebuilt.
