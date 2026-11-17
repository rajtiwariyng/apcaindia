# Legacy schema migrations

These migrations are a **reverse-engineered, version-controlled representation** of the
existing production database `apca_india` (Laravel 7 app, schema built by hand / SQL import —
migrations were never run on the live DB).

## Source of truth
The byte-exact schema is [`database/schema/apca_india_schema.sql`](../../schema/apca_india_schema.sql).
To build an identical test database, prefer:

```bash
mysql -u root test_apca < database/schema/apca_india_schema.sql
```

## Why these live in `legacy/` (not auto-run)
Laravel only auto-discovers migrations directly under `database/migrations`. These are kept in a
subfolder so they are **never accidentally run against production** and never collide with the
3 pre-existing phantom migrations (`users`, `failed_jobs`, `image_gallery`) that do not match the
live DB. To run this set against a *throwa�ay* test DB only:

```bash
php artisan migrate --path=database/migrations/legacy
```

## Known, intentional deviations from the raw SQL (cosmetic / non-functional)
- **Integer display widths dropped** (`int(100)` → `INT`). Display width is non-functional and
  deprecated in MySQL 8; behavior is identical.
- **Auto-increment id columns are reproduced as `UNSIGNED`** (Laravel's `increments()` /
  `bigIncrements()`), whereas the live tables use signed `int`/`bigint`. Non-functional for the
  positive ids in use.
- **`users.id`** is reproduced as a normal `PRIMARY KEY` auto-increment. The live table uses a
  non-standard `UNIQUE KEY` on `id` instead of a primary key — functionally equivalent for the app.
- **`tbl_admin.id`** is reproduced WITHOUT auto-increment, matching the live table (the app assigns ids).
- **`subscribed_user.created_at/updated_at`** are kept as `VARCHAR(100)` (matching live), not timestamps.
- Charset/collation per table is preserved (`latin1` / `utf8mb4`) to match string comparison behavior.

No column names, types (beyond display width), nullability, defaults, or keys are otherwise changed.

## ⚠️ IMPORTANT: this set was generated from the LOCAL `apca_india` DB, which is NOT a complete copy of production
The admin **Category** screen (`/admin/category/...`, confirmed in use) reads `tbl_course_category`,
but that table **does not exist** in the local DB — so production has at least one table the local
copy lacks. **Before the refactor modifies any module, obtain a production schema dump** and
reconcile it against this set:

```bash
# on / from the production DB:
mysqldump -u USER -p --no-data --skip-comments DBNAME > apca_india_prod_schema.sql
```

Tables present in production but missing here (e.g. `tbl_course_category`) must get their own
migration before their module is touched.

## Runtime note
Production runs **PHP 8.3** (confirmed). Laravel 7 officially supports only PHP 7.2–8.0, so the
current stack is already running outside its supported range — additional motivation to bump the
framework (Phase 7) to a version that supports PHP 8.3 (Laravel 10+).
