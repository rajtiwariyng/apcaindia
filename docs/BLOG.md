# Blog

## Data (verified 2026-11-18, local DB; demo has the same shape)
- Tables: `tbl_blog` (posts), `tbl_blog_category` (6 categories), `tbl_seo` (one `blog/<slug>` row per post). Table charset is **latin1**.
- `tbl_blog` columns: `id, uniqueid, title, blog_short_desc, description, image, category (category *name*, not id), slug, status, created_at, updated_at, ip, metatitle, metakeywords, metadesc, view_count, email_sent, img_alt`.
- Counts: **249 posts** = 242 live (`status=1`) + 7 hidden. Hidden ids: 1, 2, 3 (APCA Malaysia articles), 6, 7 (external-URL slugs `sogoodmagazine…`), 8 (Niklesh), 12 (knife set). 6 posts have no image. Live posts by category: Uncategorized 132, Baking Courses 34, Culinary Courses 24, Pastry School 20, Education 17, Culinary School 15.
- Images: `public/assets/upload/blog/<uniqid>_<name>`.

## Front behaviour
| URL | Behaviour |
|---|---|
| `/blog`, `/blog-listing` | All `status=1` posts in one list (no pagination in the controller: `get()`), category names from `tbl_blog_category`, banner from `banner_videos` where `page='blog'`. How the category filter works is in the view/JS **(not verified)**. |
| `/blog/{slug}` | One post + the 2 latest posts. **Does not check `status`** (hidden posts open by URL). Unknown slug → 500. |
| `/search-posts?term=` | Searches `title` / `blog_short_desc` (LIKE, max 10). **Currently 500** (`Undefined array key "categories"` — controller doesn't pass it to the view). |
| Home page | Controller loads the 3 latest posts but the view shows none. |
Every blog request is logged to `page_views`. `view_count` and `email_sent` columns exist; no front code increments `view_count` **(not verified for the admin)**; nothing reads `email_sent`.

## Admin (Manage Blogs, `/admin/blog/*`)
- Create/edit form fields: title, slug, category, short description, description (CKEditor), image + alt text, meta title/keywords/description, publishing status.
- Saving also creates/updates the matching **`tbl_seo` row** (`blog/<slug>`: title, description, keywords) — this is how blog tab titles are produced.
- Slug is sanitised to `[A-Za-z0-9-]` and lower-cased; a duplicate title gets the legacy suffix `-chanderpur` (new) or `-mag` (edit).
- Image: jpg/jpeg/png only, <2 MB (WebP is rejected).
- Categories: Blogs Categories module (`/admin/blogcategory`).

## WordPress import (2026-11-17; demo 2026-11-18) — full record in [changes/CR-001.md](changes/CR-001.md)
- Source: `docs/apca_blog.sql` (WordPress DB `apca_blog`, permalink structure `/%postname%/`, site `https://www.apcaindia.com/blog/`). 243 published posts; 239 imported, 4 skipped because the slug already existed. Insert-only; originals untouched.
- Mapping: title, slug, content (Gutenberg comments stripped, paragraphs added for old auto-p content), first category, featured image (downloaded), alt text, Rank Math title/description/focus keyword → meta fields **and** `tbl_seo`, dates. `₹`/`●` stored as HTML entities because the column is latin1.
- Published (`status=1`) on 2026-11-17 (local) and 2026-11-18 (demo, as part of the deploy). 173 of the 174 empty blog SEO titles were filled from the post title; 1 old row (`blog/httpswwwbfmmycontent…niklesh…`) has no matching post and stays empty.
- Scripts: `docs/import/import_wp_blog.php` (dry run by default, `--commit`), `docs/import/backfill_wp_blog_images.php`. They read the scratch DB `apca_blog_wp_scratch` (the dump imported as-is; it only exists locally).
- Demo server received the same data on 2026-11-18 (see [DEPLOYMENT.md](DEPLOYMENT.md)).

## Old WordPress URLs vs new URLs (needed for redirects — not built yet)
- Old: `https://www.apcaindia.com/blog/<post-name>/` (trailing slash). New: `/blog/<slug>`; the trailing slash is already 301-redirected by `public/.htaccess`.
- **13 slugs changed** during import (underscores/odd characters were removed, so the old URL would 404). Old `post_name` → new `slug`:

| WP ID | Old post_name | New slug |
|---|---|---|
| 51 | `academy-of-culinary-arts-bangalore-blogs_cooking-with-your-heart` | `academy-of-culinary-arts-bangalore-blogscooking-with-your-heart` |
| 57 | `academy-of-culinary-arts-bangalore-blogs_features-of-a-topnotch-culinary-school` | `academy-of-culinary-arts-bangalore-blogsfeatures-of-a-topnotch-culinary-school` |
| 63 | `academy-of-culinary-arts-bangalore-blogspot_man-or-woman-whos-the-better-cook` | `academy-of-culinary-arts-bangalore-blogspotman-or-woman-whos-the-better-cook` |
| 67 | `academy-of-culinary-arts-bangalore-blogspot_learning-cooking-through-recipe-books` | `academy-of-culinary-arts-bangalore-blogspotlearning-cooking-through-recipe-books` |
| 69 | `academy-of-culinary-arts-bangalore-blogs_a-lot-can-happen-over-a-dinner` | `academy-of-culinary-arts-bangalore-blogsa-lot-can-happen-over-a-dinner` |
| 76 | `academy-of-culinary-arts-bangalore-blogs_some-seafood-on-my-platter` | `academy-of-culinary-arts-bangalore-blogssome-seafood-on-my-platter` |
| 77 | `academy-of-culinary-arts-bangalore-blogs_dhaba-the-understated-but-much-sought-after-indian-eatery` | `academy-of-culinary-arts-bangalore-blogsdhaba-the-understated-but-much-sought-after-indian-eatery` |
| 78 | `academy-of-culinary-arts-bangalore-blogs_the-tiffin-period-and-nostalgia-attached-to-it` | `academy-of-culinary-arts-bangalore-blogsthe-tiffin-period-and-nostalgia-attached-to-it` |
| 81 | `academy-of-culinary-arts-bangalore-blogs_my-first-cooking-class` | `academy-of-culinary-arts-bangalore-blogsmy-first-cooking-class` |
| 82 | `academy-of-culinary-arts-bangalore-blogs_-north-and-south-unity-in-diversity` | `academy-of-culinary-arts-bangalore-blogs-north-and-south-unity-in-diversity` |
| 85 | `academy-of-culinary-arts-bangalore-blogs-_-big-dreams-of-a-small-town-boy` | `academy-of-culinary-arts-bangalore-blogs--big-dreams-of-a-small-town-boy` |
| 94 | `academy-of-culinary-arts-bangalore-blogs_delicious-vegetarian-food-for-everyone` | `academy-of-culinary-arts-bangalore-blogsdelicious-vegetarian-food-for-everyone` |
| 97 | `academy-of-culinary-arts-bangalore-blogs_-how-culinary-schools-evolved-in-india` | `academy-of-culinary-arts-bangalore-blogs-how-culinary-schools-evolved-in-india` |

- Old sitemap also lists blog list URLs with no equivalent: `/blog/category/<x>/`, `/blog/author/<x>/`, `/blog/page/<n>/`, tag pages (93 URLs).
- The WordPress `wp_redirection_items` table has 1 rule: `/blog/best-culinary-arts-degree-programs-in-bangalore-foraspiring-chef` → `/blog/`.

## Known issues / to do
1. Search is broken (500). 2. Hidden posts are reachable by URL. 3. 160 of 242 live posts have no meta description (WordPress had none). 4. 13 old slugs need redirects. 5. No blog block on the home page although data is loaded. 6. Posts 6 and 7 have external-URL-style slugs (original data).
