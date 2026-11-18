# Pages (public routes) — verified 2026-11-18

Legend — **Type**: **D** = content comes from the database (editable in admin), **S** = content is hard-coded in the Blade file (change = code edit), **D+S** = mixed. **SEO**: ✓ = `tbl_seo` row with title (+description), T = title only, ✗ = no row (tab title shows "APCA"). Every page also gets the shared header/footer, and most get a banner from `banner_videos` (admin "All Banner / Video") keyed by the last URL segment.

## Main pages
| URL | Controller@method | View | Data tables | Type | SEO |
|---|---|---|---|---|---|
| `/` | HomeController@home | `home/home` (+ includes `program_home`, `testimonials_home`, `partners`, `faqs_home`) | banner_videos, tbl_content, tbl_faqs (home=1), tbl_homeprogram, tbl_homeslider, tbl_placementpartners, tbl_testimonial (home=1). The controller also loads the latest 3 `tbl_blog` posts but **the home view has no blog block** (`home/bloghome` is unused). | D | ✓ |
| `/courses` | CoursesController@courses | `courses/courses` | The controller loads tbl_chefeducators, tbl_placementpartners, tbl_testimonial, but the view contains **no `$data` / `@foreach` at all** (verified: 0 uses) — it is fully static markup | S | ✗ |
| `/course/{slug}` | CoursesController@courseDetails | `courses/course-details` | courses, course_modules, banner_videos, tbl_chefeducators, tbl_homeslider (student), tbl_pdf, tbl_placementpartners, tbl_testimonial | D | ✓ for 7 of 9 courses |
| `/track-pdf-download/{id}` | CoursesController@download | — (file download, increments count) | tbl_pdf | D | — |
| `/blog` (`/blog-listing`) | BlogpageController@blog | `blogpage/blog` | banner_videos, tbl_blog (status=1), tbl_blog_category, tbl_placementpartners | D | ✓ |
| `/blog/{slug}` | BlogpageController@blogDetails | `blogpage/blogDetail` | tbl_blog, tbl_placementpartners | D | ✓ (one row per post) |
| `/search-posts` | BlogpageController@search | `blogpage/blog` | tbl_blog | D | **500 — see Known issues** |
| `/faq` | AboutusController@faq | `aboutus/faq` | tbl_faqs (status=1) | D | ✓ |
| `/gallery` | AboutusController@gallery | `aboutus/gallery` | tbl_gallery | D | ✗ |
| `/chef-educators` | AboutusController@chefEducator | `aboutus/chef-educator` | tbl_chefeducators | D | ✓ |
| `/apca-alumni` | AboutusController@apcaAlumni | `aboutus/apca-alumni` | tbl_alumni | D | T |
| `/about-us` | AboutusController@explore | `aboutus/explore` | tbl_pages (`about-us` rows), tbl_supportingbrands | D | ✗ |
| `/message-from-founder` | AboutusController@messageFromFounder | `aboutus/message-from-founder` | tbl_pages ("Message from director") | D | T |
| `/awards-accolades` | AboutusController@AwardsAccolades | `aboutus/awards-accolades` | tbl_pages ("Awards & Accolades") | D | ✓ |
| `/academy-resource` | AboutusController@academy | `aboutus/academy-resource` | tbl_pdf | D | ✗ |
| `/international-paid-internship` | AboutusController@internationalPaidInternship | `aboutus/international-paid-internship` | tbl_intprogram, tbl_intcontent | D | ✗ |
| `/international-paid-internship/{slug}` | BlogpageController@intprogrampageDetails | `blogpage/intprogram_pages` | tbl_intprogram_page, tbl_placementpartners | D | ✗ (rows exist under `intprogram-page/<slug>` with empty titles — wrong key) |
| `/contact-us` | ContactusController@contactus | `contactus/contactus` | banner_videos, tbl_placementpartners | S + form | ✓ |
| `/contact-us/store` (POST) | ContactusController@submitForm | — | contactus (insert) | D | — |
| `/subscribe` (POST) | FooterController@subscribe | — | subscribed_user (insert) | D | — |

## Centre pages
| URL | View | Data | Type | SEO |
|---|---|---|---|---|
| `/bangalore`, `/gurgaon`, `/mumbai`, `/delhi` | `aboutus/{city}` + `aboutus/partials/centre-body` | **`config/centres.php`** (text, courses, intakes, gallery) + tbl_homeprogram (course images) + tbl_faqs (home=1) + tbl_pages (director message) | D+S (content lives in a PHP config file, not the admin) | ✓ |

## Static pages (no content table; only shared banner/partners/SEO)
| URL | View | SEO |
|---|---|---|
| `/faculty` | `aboutus/faculty` (989 lines, static) | ✗ |
| `/accomodation` | `aboutus/accomodation` | ✓ |
| `/admission` | `aboutus/admission` (+ `footer/apform`) | ✗ |
| `/online-registration` | `aboutus/online-registration` (+ enquiry form) | ✓ |
| `/program-application` | `aboutus/program-application` | ✗ |
| `/program-flyers` | `aboutus/program-flyers` | ✗ |
| `/academic-intake-calendar` | `aboutus/academic-intake-calendar` | ✗ (admin has "Intake Calendar" PDF module; the view reads no data — **(not verified why)**) |
| `/apca-programs` | `aboutus/apca-programs` | ✗ |
| `/achivements`, `/achivements-gallery` | `aboutus/achivements`, `achivements-gallery` | ✗ |
| `/news`, `/news-details` | `aboutus/news`, `news-details` | ✓ / ✗ |
| `/career` | `aboutus/career` | ✓ |
| `/career-opportunities` | `aboutus/career-opportunities` | ✗ |
| `/industrial-visit` | **view `aboutus/industrial-visit` does not exist → 500** (SEO row exists) | ✓ |
| `/recipe-and-inspiration` | `aboutus/recipe-and-inspiration` | ✗ |
| `/recipes-and-inspiration` | **view `aboutus/recipes-and-inspiration` does not exist → 500** | ✗ |
| `/visit-the-academy` | `aboutus/visit-the-academy` (+ campus-tour form) | ✗ |
| `/pay-now` | `aboutus/pay-now` (+ pay-now form) | ✓ |
| `/privacy-policy`, `/terms-and-conditions` | `aboutus/privacy-policy`, `terms-and-conditions` | ✗ |

## Utility / broken routes
| URL | Result |
|---|---|
| `/header` | 200 (partial endpoint, renders `Header::header`) |
| `/footer` | **500** — view `Footer::welcome` does not exist |
| `/categories/{category}`, `/{currency}/categories/{category}` | **500** — views `Categories::index`, `Categories::MY.index`, `Categories::IN.index` don't exist and table `tbl_course` doesn't exist. Nothing on the site links to these URLs (verified by grep). |
| `/industrial-visit`, `/recipes-and-inspiration` | **500** — the views `Aboutus::industrial-visit` / `Aboutus::recipes-and-inspiration` do not exist (found 2026-11-18). The old URL `pastry-culinary-institute.html` (Industrial Visit & Educational Tour) needs this page built from the live site. |
| `/up` | Laravel health check |
| `/storage/{path}` | 403 (storage link route) |

## Views that exist but are never used (verified by cross-referencing controllers + includes)
`aboutus/about-us`, `aboutus/blog`, `aboutus/blog-details`, `aboutus/courses`, `courses/advanced-diploma-dual-program`, `courses/advanced-diploma-in-culinary-arts`, `courses/advanced-diploma-in-pastry-bakery-arts`, `courses/asia-pastry-forum`, `courses/days-24-intensive-pastry-program`, `courses/weekend-part-time-pastry-program`, `courses/weeks2-intensive-bakery-program`, `courses/weeks2-intensive-chocolate-program`, `header/header-home`, `home/bloghome`, `welcome`, `admin/categorycreate`, `admin/categorylisting`, `admin/contactuspage`.
`aboutus/about-us` itself is unused, but it is the only file that includes `Footer::bloghome` (which does not exist) — another sign it is a leftover.
Course detail pages all render through the single dynamic `courses/course-details` view; the per-course static views above are legacy leftovers.

## Redirects and sitemap (added 2026-11-18, local + demo)
| URL | Behaviour |
|---|---|
| `/sitemap.xml` | Generated by `SitemapController`: 35 static pages + 7 courses + 5 international programs + all live blog posts (**289 URLs, all verified 200** — locally and on the demo; each environment lists its own domain). Never lists hidden or broken pages. `robots.txt` does **not** reference it yet (production domain not decided). |
| `/blog/<old-wordpress-slug>` (13 slugs) | **301** to the new slug. Map in `config/redirects.php`. |
| `/blog/category/*`, `/blog/author/*`, `/blog/page/*`, `/blog/tag/*` | **301** to `/blog` |
| Old `*.html` pages (69) | **No redirects yet** (404) — see [STATUS.md](STATUS.md) |
Apache's trailing-slash rule (`public/.htaccess`) 301s `/x/` to `/x` first, so on Apache an old URL with a trailing slash takes two hops (slash, then our redirect). Tests: `tests/Feature/Front/RedirectsTest.php` (pass).

## Known issues on public pages
1. Unknown slug on `/blog/{slug}`, `/course/{slug}`, `/international-paid-internship/{slug}` → 500 instead of 404.
2. `/search-posts` → 500 (`Undefined array key "categories"` — controller doesn't pass categories to the view).
3. `/blog/{slug}` does not check `status` — a hidden post (status 0) opens if you know the URL.
4. `/footer`, `/categories/*` → 500 (missing views/table).
5. 21 public pages have no SEO row — see [SEO.md](SEO.md).
6. `/industrial-visit` and `/recipes-and-inspiration` return 500 (view files missing).
7. Course pages for `weeks2-intensive-bakery-program` and `weekend-part-time-pastry-program-old` have no SEO row.
