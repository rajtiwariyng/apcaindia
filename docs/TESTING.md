# Testing (verified 2026-11-17)

## What exists
PHPUnit 11. 4 test files, 15 test methods:
- `tests/Feature/Admin/AdminModulesTest.php` (5), `AdminWritePathTest.php` (4), `BlogAdminTest.php` (3)
- `tests/Feature/Front/FrontPagesTest.php` (3)
- `tests/Unit/ExampleTest.php` (Laravel default)
`phpunit.xml` is configured for SQLite `:memory:`, but the feature tests hit MySQL using the legacy production DB name.

## Current result
`php artisan test` → **29 failed, 4 passed**. All failures seen were `SQLSTATE[HY000] [1049] Unknown database 'apca_india'` — the tests expect a MySQL database named `apca_india`, which does not exist locally (local DB is `apcaindia`). **Not caused by the blog/SEO/centre-page work** (the same failure existed before). Cause not investigated further.

## Warning
`AdminWritePathTest` writes to the database. **Do not create an `apca_india` database or point tests at `apcaindia`/demo/production** to make them pass — create a separate throw-away test database (a copy of the schema) first, or fix the tests to use SQLite/a test DB.

## Not covered by any test
Centre pages (`/bangalore`, `/gurgaon`, `/mumbai`), header meta output, FAQ page, blog search, redirects (none exist yet), the importers.

## Manual checks used so far (HTTP)
`/`, `/faq`, `/blog`, `/blog/{slug}`, `/bangalore`, `/gurgaon`, `/mumbai`, `/delhi`, `/apca-alumni` return 200 locally; title/description verified via page source. Known failing routes are listed in [PAGES.md](PAGES.md#known-issues-on-public-pages).

## Rules
Add a regression test for each behaviour change. Report real pass/fail output; never claim a check that was not run.
