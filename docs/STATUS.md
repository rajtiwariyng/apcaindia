# Status — what is built, what is pending (read this first)

Updated 2026-11-18. Git: branch `main` → https://github.com/rajtiwariyng/apcaindia.git. Videos (`*.mp4/*.mov/*.avi`) are **not in git** (GitHub 100 MB limit) — they exist only on disk/servers.

## ✅ Built and working (local)
- Laravel 12 site + admin ported from the legacy app; all public routes in [PAGES.md](PAGES.md); admin modules in [ADMIN.md](ADMIN.md).
- **Blog:** 249 posts (242 live) incl. 239 imported from WordPress with images, categories and SEO rows → [BLOG.md](BLOG.md).
- **SEO:** header templates print title/description/keywords from `tbl_seo`; 24 sheet rows + 25th alumni title + blog titles applied → [SEO.md](SEO.md).
- **Logos/icons/images:** header logos (white/blue), footer logo, social icons, WhatsApp button, "A" watermark, home/course/sponsor images restored (`public/assets/images`).
- **Footer:** campus column now links Bangalore/Gurugram/Mumbai/Delhi to the new pages; Malaysia → https://www.apcamalaysia.com (local only).
- **Centre pages Bangalore / Gurgaon / Mumbai** rebuilt in the new theme from the live site's content (`config/centres.php`, shared partial): intro (+video on Bangalore), detail sections, achievements, real course cards (images from Home Program), upcoming intakes, centre photo gallery, Apply Now button → modal (local only).
- **Demo server** (https://demo.karmatech.in) has the blog import, SEO rows, header meta output and the white footer logo → [DEPLOYMENT.md](DEPLOYMENT.md).
- Docs (this folder).

## 🟡 Started / paused
| Item | State |
|---|---|
| **FAQ import from live site** (27 missing of 37) | Analysed, **not imported**. Plan in [FAQ.md](FAQ.md). Waiting: confirm answer formatting (plain text vs HTML). |
| **"Apply Now"** | A modal already exists (header **Apply** button and the new city-page buttons open `#exampleModal`, posting to `contact-us/store`). Static pages `/online-registration`, `/admission`, `/program-application` also exist. **No separate `/apply-now` page** — decide whether one is wanted. |
| **Delhi page** | Still the old static view; not rebuilt from live `delhi.html`. |
| **Gurgaon/Mumbai/Bangalore → demo** | Not deployed yet. |

## 🔲 Planned / not started (need owner decisions — don't assume)
1. **Old-URL redirects.** Old site: 315 URLs (69 `.html`, 245 `/blog/...`, home). New site has **no redirects**. Plan: `config/redirects.php` map + 301 routes + tests; 13 changed blog slugs ([BLOG.md](BLOG.md)); 93 blog list URLs (`category/author/page/tag`) → `/blog`. Needs an approved `redirect-map.csv` first.
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
| 10 | Security items | [SECURITY.md](SECURITY.md) |

## Cleanup candidates (unused code — don't delete without approval)
18 unreferenced views listed in [PAGES.md](PAGES.md); empty/unused tables `tbl_admin`, `tbl_manage_banner`; unused upload folders `cakefondant`, `chefs`, `homebanner`, `news`.

## Uncommitted work
None at the time of the last push (2026-11-18). Anything newer is listed in [CHANGELOG.md](CHANGELOG.md). Commit/push only on explicit request (see `AGENTS.md`).
