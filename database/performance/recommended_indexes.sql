-- ============================================================================
-- Recommended indexes for apca_india  (PROPOSAL — review before running)
-- ============================================================================
-- These are ADD INDEX statements only. They do NOT alter data and are
-- online-safe on InnoDB (secondary-index creation does not lock the table on
-- modern MySQL/MariaDB). Each is reversible with DROP INDEX.
--
-- HOW TO USE
--   1. Take a backup first (mysqldump apca_india).
--   2. For each statement, check it does not already exist:
--        SHOW INDEX FROM <table>;
--      then run the ones that are missing. (MySQL 8 has no
--      "ADD INDEX IF NOT EXISTS"; MariaDB 10.0.2+ does.)
--   3. Apply on a staging copy and re-test before production.
--
-- WHY THESE
--   - Every admin edit/detail/status/delete looks a row up by `uniqueid`
--     (WHERE uniqueid = ...). These are the hottest point lookups in the app.
--   - The public site filters almost everything by `status = 1`.
--   - A few columns are filtered directly (course_id, category, page, slug, url).
--
-- NOT INDEXED ON PURPOSE
--   - contactus email/mobile/full_name and blog title/description use
--     LIKE '%term%' (leading wildcard) — a normal B-tree index cannot help;
--     a FULLTEXT index would be needed if that search becomes slow.
-- ============================================================================

-- ---- uniqueid point lookups (admin edit/status/delete + public detail) -----
ALTER TABLE `tbl_blog`             ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_blog_category`    ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_testimonial`      ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_gallery`          ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_placementpartners` ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_supportingbrands` ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_alumni`           ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_chefeducators`    ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_faqs`             ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_homeprogram`      ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `banner_videos`        ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_pdf`              ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_homeslider`       ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_intprogram`       ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_intcontent`       ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_intprogram_page`  ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `tbl_content`          ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `course_modules`       ADD INDEX `idx_uniqueid` (`uniqueid`);
ALTER TABLE `courses`              ADD INDEX `idx_uniqueid` (`uniqueid`);
-- `tbl_pages`.uniqueid is TEXT in the schema; index a prefix only:
ALTER TABLE `tbl_pages`            ADD INDEX `idx_uniqueid` (`uniqueid`(191));

-- ---- status filters (public site reads "WHERE status = 1") ------------------
ALTER TABLE `tbl_blog`             ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_testimonial`      ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_placementpartners` ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_chefeducators`    ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_alumni`           ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_gallery`          ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_faqs`             ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_homeprogram`      ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_intprogram`       ADD INDEX `idx_status` (`status`);
ALTER TABLE `tbl_intprogram_page`  ADD INDEX `idx_status` (`status`);

-- ---- targeted column filters seen in queries -------------------------------
-- course_modules are fetched by course_id (+ status, + order):
ALTER TABLE `course_modules`  ADD INDEX `idx_courseid_status` (`course_id`, `status`);
-- home slider / student section filter by category (+ page):
ALTER TABLE `tbl_homeslider`  ADD INDEX `idx_category_page` (`category`, `page`);
-- banners and pdfs are fetched by `page`:
ALTER TABLE `banner_videos`   ADD INDEX `idx_page` (`page`);
ALTER TABLE `tbl_pdf`         ADD INDEX `idx_page` (`page`);
-- pdf is also joined/looked up by slug (course-details + downloads):
ALTER TABLE `tbl_pdf`         ADD INDEX `idx_slug` (`slug`);
-- newsletter duplicate-email check:
ALTER TABLE `subscribed_user` ADD INDEX `idx_email` (`email`);
-- dashboard groups page_views by url (13k+ rows and growing):
ALTER TABLE `page_views`      ADD INDEX `idx_url` (`url`);
-- SEO rows are matched by url_slug (TEXT -> prefix index):
ALTER TABLE `tbl_seo`         ADD INDEX `idx_url_slug` (`url_slug`(191));
