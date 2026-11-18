# Dynamic vs static — who can change what

**Dynamic** = stored in the database and edited through the admin panel (no code change).
**Static** = typed directly into a Blade view or a config file (a developer must edit and deploy).
Verified 2026-11-18 from controllers, views and the database. Page-by-page detail: [PAGES.md](PAGES.md).

## Dynamic (admin-editable)
| Content | Admin module | Table | Shows on |
|---|---|---|---|
| Page banners (image/video) | All Banner / Video | `banner_videos` (key `page` = URL's last segment, a course slug, or `home`) | most pages that print `$data['banner']`: about-us, academy-resource, accomodation, alumni, awards, blog, career, chef-educators, contact-us, faq, gallery, international-paid-internship, message-from-founder, online-registration, pay-now, recipe-and-inspiration, centre pages, course pages, home |
| Home sliders (section 1 / section 2) | Home Slider | `tbl_homeslider` | home |
| Student story (home, per course) | Student Section | `tbl_homeslider` (`category='student'`, `page`) | home, course pages |
| Home slider text | Slider Content | `tbl_content` (1 row) | home |
| Program cards | Home Program | `tbl_homeprogram` (10 rows) | home; also the **images** on centre-page course cards |
| Blog posts + categories | Manage Blogs / Blogs Categories | `tbl_blog`, `tbl_blog_category` (+ `tbl_seo`) | `/blog`, `/blog/{slug}` — see [BLOG.md](BLOG.md) |
| FAQs | Faqs | `tbl_faqs` (40) | `/faq`; 4 flagged `home=1` also on home and city pages — see [FAQ.md](FAQ.md) |
| Testimonials | Manage Testimonials | `tbl_testimonial` (all 9 have home=1) | home; course pages |
| Gallery items | Gallery | `tbl_gallery` (30) + `gallary_category` (3) | `/gallery` |
| Placement partners (logo strip) | Placement Partners | `tbl_placementpartners` (17) | partner strip on most pages |
| Supporting brands | Supporting Brands | `tbl_supportingbrands` (10) | about-us |
| Chef educators | Chef Educators | `tbl_chefeducators` (51) | `/chef-educators`, course pages |
| Alumni | Manage Alumni | `tbl_alumni` (17) | `/apca-alumni` |
| Courses + their modules | Manage Coursepage (+ course modules) | `courses` (9), `course_modules` (55) | `/course/{slug}` |
| Course brochure PDFs, Academy Resource, Program Flyer, Intake Calendar PDF | Academy Resource / Program Flyer / Intake Calendar | `tbl_pdf` (14) | course pages (download), `/academy-resource` |
| CMS text blocks | Manage Page | `tbl_pages` (6 rows: "Message from director", "Awards & Accolades", four `about-us` blocks) | `/message-from-founder`, `/awards-accolades`, `/about-us`, city pages (director message) |
| International programs | International Program / Content / International Page | `tbl_intprogram` (6), `tbl_intcontent` (1), `tbl_intprogram_page` (5) | `/international-paid-internship`, `/international-paid-internship/{slug}` |
| Contact / apply / appointment submissions | Appointment Data (read-only list + CSV) | `contactus` (18) | admin only |
| Page titles / descriptions | none (no admin screen) — blog posts write their own row; everything else is **SQL only** | `tbl_seo` (278) | `<title>` + meta tags on every page — see [SEO.md](SEO.md) |

## Static (developer-edited)
| What | Where |
|---|---|
| **Centre pages' text, courses, intake dates, centre photos** (Bangalore, Gurgaon, Mumbai, Delhi) | `config/centres.php` (+ images in `public/assets/images/centres/`) |
| `/courses` listing page (the whole page — controller data is unused) | `resources/views/courses/courses.blade.php` |
| `/faculty`, `/accomodation`, `/admission`, `/online-registration`, `/program-application`, `/program-flyers`, `/academic-intake-calendar`, `/apca-programs`, `/achivements`, `/achivements-gallery`, `/news`, `/news-details`, `/career`, `/career-opportunities`, `/recipe-and-inspiration`, `/visit-the-academy`, `/pay-now`, `/privacy-policy`, `/terms-and-conditions` | the matching file in `resources/views/aboutus/` |
| Header navigation, footer link columns, campus links, newsletter row | `resources/views/header/*.blade.php`, `resources/views/footer/footer.blade.php` |
| Apply Now modal, Enquire Now popup, appointment/enquiry forms | `resources/views/footer/*`, `aboutus/enquiry-form`, `courses/appointment-form` |
| Static site images (logos, icons, sponsor logos, banners) | `public/assets/images/` (not editable in admin) |
| Form validation + saving | `ContactusController@submitForm` (all forms share it, `page_name` tells them apart) |

*(Not listed above: `/industrial-visit` and `/recipes-and-inspiration` — their view files do not exist, so they currently return 500.)*

## Mixed
- **Course detail page** (`/course/{slug}`): everything comes from the DB, but the layout blocks (appointment form, partners, testimonials) are fixed partials.
- **Centre pages**: course *images* are dynamic (Home Program admin) while all other content is static (config file).
- **Home page**: dynamic content blocks inside a fixed layout; the latest-blog data is loaded but not displayed.

## Rule of thumb for new work
If a client will want to edit it → make it a DB-backed admin module (or reuse `tbl_pages`/`tbl_faqs`). If it rarely changes → a config file or Blade view is acceptable, but record it in this file.
