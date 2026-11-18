# Status — what is built, what is pending (read this first)

Updated 2026-11-18. Git: branch `main` → https://github.com/rajtiwariyng/apcaindia.git. Videos (`*.mp4/*.mov/*.avi`) are **not in git** (GitHub 100 MB limit) — they exist only on disk/servers.

## ✅ Built and working (local)
- **FAQ page:** 40 FAQs — the 27 missing live-site FAQs were imported as plain text on 2026-11-18 → [FAQ.md](FAQ.md). Local **and demo**.
- Laravel 12 site + admin ported from the legacy app; all public routes in [PAGES.md](PAGES.md); admin modules in [ADMIN.md](ADMIN.md).
- **Blog:** 249 posts (242 live) incl. 239 imported from WordPress with images, categories and SEO rows → [BLOG.md](BLOG.md).
- **SEO:** header templates print title/description/keywords from `tbl_seo`; 24 sheet rows + 25th alumni title + blog titles applied → [SEO.md](SEO.md).
- **Logos/icons/images:** header logos (white/blue), footer logo, social icons, WhatsApp button, "A" watermark, home/course/sponsor images restored (`public/assets/images`).
- **Footer:** campus column now links Bangalore/Gurugram/Mumbai/Delhi to the new pages; Malaysia → https://www.apcamalaysia.com. Local and demo.
- **Centre pages Bangalore / Gurgaon / Mumbai / Delhi** rebuilt in the new theme from the live site's content (`config/centres.php`, shared partial): intro (+video on Bangalore), detail sections, achievements, real course cards (images from Home Program), upcoming intakes, centre photo gallery, Apply Now button → modal (local only).
- **Demo server** (https://demo.karmatech.in) is up to date with local (blog import, SEO rows, header meta, logos, FAQs, centre pages, footer) → [DEPLOYMENT.md](DEPLOYMENT.md). Production: untouched.
- Docs (this folder).

- **Blog old-URL redirects:** 13 changed slugs + blog list URLs → 301 (`config/redirects.php`, tested). Local **and demo**.
- **Delhi page** rebuilt from live `delhi.html` (same partial/config as the other centres). Live Delhi intake dates are already in the past (copied as-is); the live Delhi photos are the Gurgaon ones. Local and demo.
- **`/sitemap.xml`** generated from live data (289 URLs, all 200). `robots.txt` not changed (production domain undecided). Local and demo (demo: 289 URLs, all 200).

## 🟡 Started / paused
| Item | State |
|---|---|
| **"Apply Now"** | A modal already exists (header **Apply** button and the new city-page buttons open `#exampleModal`, posting to `contact-us/store`). Static pages `/online-registration`, `/admission`, `/program-application` also exist. **No separate `/apply-now` page** — decide whether one is wanted. |

## 🔲 Planned / not started (need owner decisions — don't assume)
1. **Old-URL redirects for the 69 `.html` pages.** Old site: 315 URLs. Blog redirects are done (local); the `.html` pages still 404 on the new site (29 have a counterpart page, 40 have none). Needs an approved `redirect-map.csv` first.
2. **Missing pages** (old URLs with no new page): 14 award detail pages (`award_*`, `pastry-queen`, …), 13 student profile pages (`niklesh`, `charles`, …), `events-*` (3), `malaysia`, `phillipines`, `master-class`, `degree-program`, `newsletter`, `recipe-ebooks`, `center`, `intensive-pastry`. Choose per group: redirect to nearest page vs build a real page (content from the old site).
3. **SEO wording** for 20 public pages + 2 courses + 5 international pages + 160 blog descriptions → [SEO.md](SEO.md); and the 11 unmapped sheet rows.
4. **Fix known bugs** (below).
5. **Sync centre config with live** when intake dates change (`config/centres.php` is static text; Mumbai's degree intake "17th Aug 2026" is already in the past — copied as-is from the live site).
6. **Production deployment**; **git remote/push** (no remote configured); **tests** that run locally ([TESTING.md](TESTING.md)).

## 🐞 Known bugs (verified)
| # | Bug | Where |
|---|---|---|
| 1 | `/search-posts` → 500 (`categories` not passed to view) | BlogpageController@search |
| 2 | Unknown `/blog/{slug}`, `/course/{slug}`, `/international-paid-internship/{slug}` → 500 (should be 404) | Blogpage/Courses controllers |
| 3 | `/categories/*` → 500 (views + `tbl_course` table missing) — not linked anywhere | CategoriesController |
| 4 | `/footer` → 500 (`Footer::welcome` missing); `Header::IN/MY`, `Footer::404/privacy` views missing | Header/FooterController |
| 5 | Hidden blog posts open by URL (no status check) | blogDetails |
| 6 | Home page loads latest blogs but shows none | `home/home.blade.php` |
| 7 | International program SEO rows use the wrong key (`intprogram-page/…` vs real URL `international-paid-internship/…`) | tbl_seo |
| 8 | Tests can't run locally (DB `apca_india` missing) | tests/ |
| 9 | Admin image upload rejects WebP | ImageUploadService |
| 10 | `/industrial-visit` and `/recipes-and-inspiration` → 500 (view files `aboutus/industrial-visit`, `aboutus/recipes-and-inspiration` missing). `industrial-visit` has an SEO row and an old URL (`pastry-culinary-institute.html`) | AboutusController |
| 11 | Security items | [SECURITY.md](SECURITY.md) |

## Cleanup candidates (unused code — don't delete without approval)
18 unreferenced views listed in [PAGES.md](PAGES.md); empty/unused tables `tbl_admin`, `tbl_manage_banner`; unused upload folders `cakefondant`, `chefs`, `homebanner`, `news`.

## Uncommitted work
None after the 2026-11-18 commit/push that follows demo deployment #3. Anything newer is in [CHANGELOG.md](CHANGELOG.md). Commit/push/deploy only on explicit request (see `AGENTS.md`).
