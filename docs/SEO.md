# SEO (titles, descriptions, keywords)

## How it works (verified)
- Table **`tbl_seo`** (latin1): `id, url_slug, page_name, seo_title, seo_desc, seo_keywords, created_at, updated_at`. **278 rows locally.**
- Each header template (`header/header.blade.php`, `header-home`, `header-fixed`) builds a key from the URL — `/` for home, the first segment (`faq`), or `segment1/segment2` (`blog/<slug>`, `course/<slug>`) — and reads the matching row. It prints `<title>` (falls back to `APCA` when empty) and `<meta name="description">` / `<meta name="keywords">` **only when not empty**. (This output was added 2026-11-17; before that the title was hard-coded and no meta was printed.)
- **No admin screen edits `tbl_seo`.** Blog posts and International Program pages write their own row on save. Everything else is changed with SQL.
- Page-level rows are keyed by the **new** URL (e.g. `faq`, `course/advanced-diploma-in-culinary-arts`).

## Source of titles/descriptions
- `docs/apca-metas.xlsx` (36 rows, legacy `.html` URLs). 24 rows mapped to new URLs and inserted; `apca-alumni` got a title only (the sheet's alumni description is a copy of the accommodation text). Scripts: `docs/import/gen_seo_metas_sql.py` → `docs/import/apply_seo_metas.sql`.
- Blog posts: Rank Math title/description from WordPress; empty titles filled from the post title.

## Pages WITH a title (local DB)
`/`, `blog`, `faq`, `pay-now`, `contact-us`, `news`, `career`, `accomodation`, `online-registration`, `message-from-founder` (title only), `bangalore`, `gurgaon`, `mumbai`, `delhi`, `awards-accolades`, `industrial-visit`, `chef-educators`, `apca-alumni` (title only), 7 `course/<slug>` pages, and all blog posts (title; 160 of 242 have no description).

## Pages WITHOUT a title and description (wording must come from the owner)
**Public pages (20):** `about-us`, `academic-intake-calendar`, `academy-resource`, `achivements`, `achivements-gallery`, `admission`, `apca-programs`, `career-opportunities`, `courses`, `faculty`, `gallery`, `international-paid-internship`, `news-details`, `privacy-policy`, `program-application`, `program-flyers`, `recipe-and-inspiration`, `recipes-and-inspiration`, `terms-and-conditions`, `visit-the-academy`.
**Courses (2):** `course/weekend-part-time-pastry-program-old`, `course/weeks2-intensive-bakery-program`.
**International programs (5):** `international-paid-internship/{france, spain, italy, maldives--mauritius, australia}` — their rows exist under the wrong key `intprogram-page/<slug>` with empty titles, so they never match (pre-existing).
**Title but no description:** `apca-alumni`, `blog`, `message-from-founder`.

## Sheet rows not applied (11) — decisions needed
`culinary-course`, `pastry-course` (category pages `/categories/*` are broken), `intensive-pastry` (6-week vs the 2-week course), `master-class`, `center`, `events`, `malaysia`, `phillipines`, and the 3 gallery rows (`culinary-gallery`, `pastry-gallery`, `videos-gallery` → one `/gallery` page exists, so three rows compete for it).

## Rules for new pages
Add a `tbl_seo` row (`url_slug` = the new URL without leading slash, `page_name`, `seo_title`, `seo_desc`) with the page, record it in [CHANGELOG.md](CHANGELOG.md), and add it to the table above.
