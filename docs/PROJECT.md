# Project overview

## What it is
Marketing + CMS website for **APCA India** (Academy of Pastry and Culinary Arts): programs/courses, centres (Bangalore, Gurgaon, Mumbai, Delhi), chef educators, alumni, blog, gallery, FAQs, enquiry/apply forms, and an admin panel to edit most content.

It is a **Laravel 12 rebuild of a legacy Laravel 7 app** and uses the **same legacy database schema** (`tbl_*`, `courses`, `users`, …). URLs, session keys and table names were deliberately preserved (see [ARCHITECTURE.md](ARCHITECTURE.md)).

## Environments (verified)
| Env | URL | Notes |
|---|---|---|
| Local | http://localhost:8000 (`php artisan serve`) | XAMPP MySQL DB `apcaindia` |
| Demo | https://demo.karmatech.in | aaPanel Linux server, PHP 8.3, site root `/www/wwwroot/demo.karmatech.in`, DB `sql_demo_karmatech_in` |
| Old live site | https://www.apcaindia.com | Legacy static `.html` site + WordPress blog at `/blog/` — the **source of content** being migrated |
| Sister site | https://www.apcamalaysia.com | Same codebase family; used as a source for missing images |

## Roles
| Role | How identified | Access |
|---|---|---|
| Visitor | no session | all public routes |
| Admin | session key `sessionadmin` (set by `Admin\AuthController@loginCheck`; credentials in table `users`) | all `/admin/*` routes via middleware `auth.admin` |
There is **no finer permission model** (no editor/viewer split).

## Features (what exists)
- Public pages (see [PAGES.md](PAGES.md)), blog with categories + search, FAQ page, gallery, course detail pages, centre pages, alumni, chef educators.
- Forms: contact/appointment/apply (all POST to `contact-us/store`, saved in table `contactus`), newsletter subscribe (`subscribed_user`). Enquire Now popup uses Zoho Forms markup (`zf_…` ids) — external, **(endpoint not verified)**.
- Admin CMS (see [ADMIN.md](ADMIN.md)): 20 content controllers behind 26 sidebar labels (some are group headings), contact-enquiry list + CSV download, dashboard with counts and top viewed pages.
- Page-view logging into `page_views` (57k+ rows locally).
- Per-page SEO title/description/keywords from `tbl_seo` (see [SEO.md](SEO.md)).

## Business rules found in code
- Content rows are identified by a `uniqueid` column; "status" = 1 shows, 0 hides.
- Course page ↔ banner ↔ student-story ↔ PDF are linked by the **course slug** (`banner_videos.page`, `tbl_homeslider.page`, `tbl_pdf.slug`).
- Brochure PDF downloads are counted (`/track-pdf-download/{id}`).

## Decisions already made (do not redo)
- No schema changes / no `php artisan migrate` against the legacy DB.
- md5 admin login kept as-is (insecure; needs a password-migration plan — see [SECURITY.md](SECURITY.md)).
- Imported blog posts were published (`status=1`) on 2026-11-17 locally (2026-11-18 on demo); the 7 original hidden posts stay hidden.
- Old-site URLs may differ from the new site — redirects + missing pages are **planned, not built** (see [STATUS.md](STATUS.md)).
