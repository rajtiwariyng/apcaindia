# Architecture

## Stack (verified)
- PHP 8.3 (local) / 8.3 (demo), **Laravel 12**, MySQL/MariaDB (legacy schema, mostly `latin1` tables).
- Server-rendered Blade views. **No Vite/JS build source** (`resources/css`, `resources/js` don't exist); styling/JS are static files in `public/assets` and `public/admin_assets`. `npm run build` is not needed.
- Sessions + cache: `file` driver. Queue: `sync`. Mail: `log` driver locally (no real mail sent). No Redis/queues in use.
- Query layer: mostly **`DB::table(...)`** query builder in controllers; Eloquent models exist for admin CRUD (`app/Models`).

## Request flow
```
Browser → public/index.php → routes/web.php (public) or routes/admin.php (admin, loaded with `web` middleware in bootstrap/app.php)
   public:  Front\*Controller → DB::table(...) → view('<Namespace>::<view>') → header + page + footer
   admin:   middleware auth.admin (session `sessionadmin`) → Admin\*Controller → model → Admin::* views (+ *_ajax partials for listings)
```
Health check: `GET /up`.

## Folder map
| Path | Purpose |
|---|---|
| `routes/web.php` | 53 public routes (incl. `/header`, `/footer` partial endpoints, `/up`, `/storage/{path}`) |
| `routes/admin.php` | 126 admin routes (`/admin/...`, `/admin-login`) |
| `app/Http/Controllers/Front/` | Home, Aboutus (most pages), Blogpage, Contactus, Courses, Categories, Header, Footer |
| `app/Http/Controllers/Admin/` | one controller per CMS module; shared `Concerns/AdminCrudActions` (status toggle + delete) |
| `app/Http/Middleware/AuthenticateAdmin.php` | alias `auth.admin` |
| `app/Http/Requests/Admin/StoreBlogRequest.php` | only Form Request in the project |
| `app/Services/ImageUploadService.php` | image/video/pdf upload validation + storage |
| `app/Models/` | 24 models mapped to legacy tables |
| `app/helpers.php` | `random_unique_id()`, `record_page_view()`, `encode()`, `decode()`, `getExcerpt()` |
| `config/centres.php` | content for the Bangalore/Gurgaon/Mumbai pages (see below) |
| `resources/views/` | 145 Blade files (listed in [PAGES.md](PAGES.md)) |
| `public/assets/` | `css/`, `js/`, `images/` (static site images), `upload/` (admin-uploaded media), `fonts/`, `pdf/`, a few root videos |
| `public/admin_assets/` | admin theme (bootstrap, ckeditor, fullcalendar, …) |
| `database/migrations/legacy/` | reference-only table definitions; `database/schema/apca_india_schema.sql`; `database/performance/recommended_indexes.sql` (not applied) |
| `docs/` | these docs, import/deploy scripts, backups |

## View namespaces (registered in `AppServiceProvider::boot`)
`Admin::`→`views/admin`, `Header::`→`views/header`, `Home::`→`views/home`, `Footer::`→`views/footer`, `Aboutus::`→`views/aboutus`, `Blogpage::`→`views/blogpage`, `Categories::`→`views/categories` (**folder does not exist**), `Courses::`→`views/courses`, `Contactus::`→`views/contactus`.

## Shared data and layout
- **Header** (`header/header.blade.php`, `header-fixed`, `header-home`): looks up `tbl_seo` by the URL (`/` for home, `seg1`, or `seg1/seg2`) and prints `<title>`, description, keywords (changed 2026-11-17, see CHANGELOG). Contains the nav and the **Apply** button that opens the Apply modal `#exampleModal`.
- **Footer** (`footer/footer.blade.php`): newsletter row, link columns, campus links, floating WhatsApp button, and includes the **Apply Now** modal (`applynowpopup`) and **Enquire Now** popup (`enquirynowpopup`).
- `AboutusController::base()` returns `banner` (row of `banner_videos` where `page` = last URL segment and status=1) and `placementpartners`. Banner **video/image per page is therefore admin-controlled by the URL's last segment**.
- `AboutusController::cityData()` (city pages): `foundermsg` (`tbl_pages` "Message from director"), `faqs` (`tbl_faqs` with `home=1`), page-view log.
- `AboutusController::centrePage($city)`: loads `config/centres.php` and resolves each course image from `tbl_homeprogram` (by course slug), falling back to `assets/images/placeholder.jpg`.

## Centre pages (Bangalore / Gurgaon / Mumbai)
Hero + enquiry form + callback form + FAQs + partners + map stay in each view; the middle (intro, sections, courses, intakes, gallery) is the shared partial `aboutus/partials/centre-body.blade.php`, filled from `config/centres.php` (content copied from the live site on 2026-11-18). **Delhi still uses its old static view.** Intake dates are static text in the config — update them there.

## Uploads
Admin uploads go through `ImageUploadService` into `public/assets/upload/<folder>/` with filename `uniqid()_originalname`. Images: jpg/jpeg/png < 2 MB; banner video mp4/mov/avi ≤ 300 MB; PDF ≤ 20 MB. Folders written by admin modules are listed in [ADMIN.md](ADMIN.md). Folders `cakefondant`, `chefs`, `homebanner`, `news` exist but nothing in the code references them.

## Auth (admin)
`POST /admin/login_check` checks `users.email` + `md5(password)`; on success stores `sessionadmin` = {userid, name, email}. `auth.admin` redirects to `/admin-login` when the key is missing. Table `tbl_admin` exists but **no code references it**.

## Error handling (verified behaviour)
- Unknown static URL → 404. Unknown `/blog/{slug}`, `/course/{slug}`, `/international-paid-internship/{slug}` → **500** (null row not handled).
- No custom error views (`resources/views/errors` does not exist).
