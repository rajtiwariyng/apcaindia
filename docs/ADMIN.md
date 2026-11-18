# Admin panel — verified 2026-11-18

## Access
- Login page: `/admin-login`. `POST /admin/login_check` checks `users.email` + `md5(password)`; success stores session key `sessionadmin` = `{userid, name, email}`. Logout: `GET /admin/logout`. `users` has 2 rows. Table `tbl_admin` (2 rows) is **not used by any code**.
- Every `/admin/*` route except login/logout is behind middleware `auth.admin` (redirects to `/admin-login`). 126 admin routes in `routes/admin.php`.
- Theme: `public/admin_assets/` (bootstrap, CKEditor, FullCalendar, jQuery UI, inputmask). Layout partials: `views/admin/common-file/{header,sidebar,footer}`.
- Dashboard (`/admin/dashboard`): counts of live blogs, testimonials, placement partners, supporting brands, chef educators, alumni, international programs, total enquiries, plus top-10 viewed URLs from `page_views`.

## Sidebar labels (26)
Dashboard · All Banner / Video · Student Section · Home Page · Home Slider · Slider Content · Home Program · Manage Blogs · Blogs Categories · Manage Testimonials · Gallery · Appointment Data · Placement Partners · Supporting Brands · Chef Educators · Manage Alumni · Manage Coursepage · Manage Page · International Page · International Program · Content · Program Page · Academy Resource · Program Flyer · Intake Calendar · Faqs. (Some are group headings; which label links to which route below is **not verified label-by-label**.)

## Modules (controller → table → upload folder)
Pattern for almost every module: `listing/{d?}` (page + `*_ajax` partial), `create` / `create/{url?}` (new / edit by `uniqueid`), `addupdate` (POST save), `*_status` (POST toggle, via `AdminCrudActions`), `delete…` (POST). Status 1 = visible on the site.

| Route base | Controller | Table | Upload folder (`public/assets/upload/…`) | Rows |
|---|---|---|---|---|
| `/admin/bannervideo` | BannervideoController | `banner_videos` | `bannervideo` (image jpg/png <2 MB; video mp4/mov/avi ≤300 MB) | 20 |
| `/admin/homeslider`, `/admin/homeslidercontent` | HomesliderController | `tbl_homeslider`, `tbl_content` | `homeslider` | 30 / 1 |
| `/admin/studentsection` | StudentsectionController | `tbl_homeslider` (category student) | `studentsection` | (in 30) |
| `/admin/homeprogram` | HomeprogramController | `tbl_homeprogram` | `homeprogram` | 10 |
| `/admin/blog/*`, `/admin/addbloginfo`, `/admin/deleteblogdata` | BlogController | `tbl_blog` (+ writes `tbl_seo`) | `blog` | 249 |
| `/admin/blogcategory` | BlogcategoryController | `tbl_blog_category` | — | 6 |
| `/admin/testimonial` | TestimonialController | `tbl_testimonial` | `testimonial` | 9 |
| `/admin/gallery` | GalleryController | `tbl_gallery` | `photogallery` | 30 |
| `/admin/contactus`, `/admin/contact-download` | ContactEnquiryController | `contactus` | — (read + CSV) | 18 |
| `/admin/placementpartners` | PlacementpartnersController | `tbl_placementpartners` | `placementpartners` | 17 |
| `/admin/supportingbrands` | SupportingbrandsController | `tbl_supportingbrands` | `supportingbrands` | 10 |
| `/admin/chefeducators` | ChefeducatorsController | `tbl_chefeducators` | `chefeducators` | 51 |
| `/admin/alumni` | AlumniController | `tbl_alumni` | `alumni` | 17 |
| `/admin/coursepage` | CoursepageController | `courses` | `coursepage` | 9 |
| `/admin/coursemodule/…` | CoursemoduleController | `course_modules` | `coursemodule` | 55 |
| `/admin/pages` | PagesController | `tbl_pages` | `pages` | 6 |
| `/admin/pdf`, `/admin/intakecalender` | PdfController | `tbl_pdf` | `pdf` (pdf ≤20 MB) | 14 |
| `/admin/intprogram`, `/admin/intcontent` | IntprogramController | `tbl_intprogram`, `tbl_intcontent` | `intprogram` | 6 / 1 |
| `/admin/intprogrampage` | IntprogrampageController | `tbl_intprogram_page` (+ writes `tbl_seo`) | `intprogram_page` | 5 |
| `/admin/faqs` | FaqsController | `tbl_faqs` | — | 40 |

Shared code: `Admin\Concerns\AdminCrudActions` (status toggle by `uniqueid`; delete guarded by table name), `App\Services\ImageUploadService` (extensions + size rules; failures return the legacy messages), `app/helpers.php::random_unique_id()` for new `uniqueid`s.

## What admin cannot do
- Edit `tbl_seo` (titles/descriptions) directly — only blog posts and international program pages write their own SEO row.
- Edit centre pages (`config/centres.php`), static pages, header/footer links, intake dates on centre pages.
- Manage admin users (no screen; `users` rows are edited in SQL). No roles/permissions.

## Known admin issues
- md5 password hashing and no login throttling — see [SECURITY.md](SECURITY.md).
- Image uploader accepts only jpg/jpeg/png (WebP/JPEG-2000 will be rejected), though the site can display `.webp` (12 imported blog images are webp).
- Views `admin/categorycreate`, `categorylisting`, `contactuspage` exist but are unused.
