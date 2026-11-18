# Database

Local DB: MySQL/MariaDB `apcaindia` (imported from `apcaindia.sql`, then changed by the blog/SEO import — see CR-001). Demo DB: `sql_demo_karmatech_in`. Schema reference: `database/schema/apca_india_schema.sql`, `database/migrations/legacy/*` (reference only — **do not run migrations**; the dump has no `migrations` table). Suggested indexes (never applied): `database/performance/recommended_indexes.sql`.

**Charset:** every table is `latin1_swedish_ci` except `contactus` (utf8mb4) and `users` (utf8mb4). Characters outside Windows-1252 (e.g. `₹`, emoji) cannot be stored in the latin1 columns — the blog import stores them as HTML entities. Do not "convert" columns without a plan (shared production schema).

All content tables use `uniqueid` (varchar) + `status` (1 = visible) + `created_at/updated_at` (+ `ip`).

## Tables (local row counts, 2026-11-18)
| Table | Rows | Purpose / used by | Key columns |
|---|---|---|---|
| `users` | 2 | Admin logins (md5 password) | name, email, password |
| `tbl_admin` | 2 | **Unused** (no code references it) | — |
| `tbl_blog` | 249 | Blog posts — [BLOG.md](BLOG.md) | title, slug, description, image, category(name), status, meta*, img_alt |
| `tbl_blog_category` | 6 | Blog categories | category_name |
| `tbl_seo` | 278 | Page titles/descriptions — [SEO.md](SEO.md) | url_slug, page_name, seo_title, seo_desc, seo_keywords |
| `tbl_faqs` | 40 | FAQs — [FAQ.md](FAQ.md) | question, answer, home |
| `banner_videos` | 20 | Page banners (image/video); `page` = URL last segment / course slug / `home` | video_path, image, page |
| `tbl_homeslider` | 30 | Home sliders (`category` = `section 1`/`section 2`/`student`; student rows carry `page` = course slug or `home`) | image, category, page, order_by, caption |
| `tbl_content` | 1 | Home slider text | title, title2, content, content2 |
| `tbl_homeprogram` | 10 | Home program cards; also course images on centre pages (matched by `slug`) | slug, image, name, duration, order_by |
| `courses` | 9 | Course detail pages | slug, title, image, duration, schedule, certification, internship, overview, structure, bonus |
| `course_modules` | 55 | Modules of a course (`course_id` = `courses.uniqueid`) | title, content, order |
| `tbl_pdf` | 14 | Brochures / resources / calendar (`slug` links to a course; `download_count`) | title, slug, pdf_path, page |
| `tbl_testimonial` | 9 | Testimonials (`home=1` on home) | name, program, description, home |
| `tbl_chefeducators` | 51 | Chef educators | name, designation, description, image, home |
| `tbl_alumni` | 17 | Alumni | name, designation, description, image |
| `tbl_placementpartners` | 17 | Partner logo strip | name, image |
| `tbl_supportingbrands` | 10 | Supporting brands (about-us) | name, image |
| `tbl_gallery` | 30 | Gallery items (`category`, `videourl`, `caption`, `home`) | title, category, image |
| `gallary_category` | 3 | Gallery categories (pastery, events, culinary) — read by the admin gallery create form (`admin/creategallery.blade.php`) for its category dropdown | name |
| `tbl_pages` | 6 | CMS text blocks (`pages` column: "Message from director", "Awards & Accolades", `about-us` ×4) | title, content, image, video_path, pages |
| `tbl_intprogram` | 6 | International program list | slug, name, duration, image |
| `tbl_intprogram_page` | 5 | International program detail pages (blog-like) | title, slug, description, meta* |
| `tbl_intcontent` | 1 | International page intro content | program_title, students_title, description |
| `tbl_manage_banner` | 0 | Empty. Only reference: a JS variable `tblname='tbl_manage_banner'` in `admin/contactus.blade.php` (copy-paste leftover) — no real use | — |
| `contactus` | 18 | All form submissions (`page_name` tells which form) | full_name, email, mobile, date_time, program, questions, privacy, page_name |
| `subscribed_user` | 0 | Newsletter subscribers | name, email |
| `page_views` | 57,718 | One row per tracked page hit (grows constantly; feeds the dashboard) | url, ip, user_agent |

## Relationships (by convention, no foreign keys)
- `course_modules.course_id` → `courses.uniqueid`.
- `courses.slug` ↔ `banner_videos.page` ↔ `tbl_homeslider.page` (student) ↔ `tbl_pdf.slug` ↔ `tbl_homeprogram.slug`.
- `tbl_blog.slug` ↔ `tbl_seo.url_slug = 'blog/' + slug`.
- `tbl_blog.category` is the **category name** (text), not an id.

## Backups taken during this work (local only, not in git)
`docs/backups/pre-import_tbl_blog_category_seo.sql`, `pre-metas_tbl_seo.sql`, `pre-seo-titles_tbl_seo.sql`, `pre-publish_tbl_blog_seo.sql`. Server backup (demo): `/root/apca_backup_20261118/` — see [DEPLOYMENT.md](DEPLOYMENT.md).
Scratch DB `apca_blog_wp_scratch` (local only) = the WordPress dump, source for the importer.
