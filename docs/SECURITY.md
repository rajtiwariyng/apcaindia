# Security — verified findings (2026-11-18)

Severity labels: CRITICAL / HIGH / MEDIUM / LOW. Each item was confirmed in code or config; nothing is guessed.

| # | Sev | Finding | Evidence | Recommended approach |
|---|---|---|---|---|
| 1 | HIGH | Admin passwords are hashed with **md5** (unsalted). A leaked `users` table is trivially crackable. | `AuthController@loginCheck`: `where('password', md5($password))` | Add a password migration: store `Hash::make`, accept md5 once then re-hash on successful login. Needs owner approval (changes login). |
| 2 | HIGH | **No login throttling** on `/admin/login_check` and no CAPTCHA anywhere (0 `throttle` and 0 captcha references in code). | grep of routes/bootstrap/app/resources | Add Laravel `throttle` middleware to login and the public POST endpoints. |
| 3 | MEDIUM | Public form endpoints (`/contact-us/store`, `/subscribe`) have no rate limit or spam protection; they store PII (name, email, phone) in `contactus` / `subscribed_user`. | routes + `ContactusController@submitForm` | Throttle + honeypot/CAPTCHA; retention policy for PII. |
| 4 | MEDIUM | Admin delete endpoint takes the **column name and value from the request**: `Model::where($colmn, $useridd)->delete()` (guarded only by `table === $this->table`). An authenticated admin could delete many rows at once, e.g. by sending `colmn=status`. | `Admin\Concerns\AdminCrudActions::deleteData` | Delete by `uniqueid` only; ignore client-supplied column. |
| 5 | MEDIUM | Upload checks use the **client-supplied extension** only (jpg/jpeg/png, pdf, mp4/mov/avi), not the real MIME type; files are stored under `public/assets/upload/` (publicly served; whether PHP execution is blocked there is **not verified**). | `ImageUploadService` | Verify MIME + re-encode images; block script execution in the upload folders (server config). |
| 6 | MEDIUM | `APP_DEBUG=true` and `APP_ENV=local` locally; the demo's values were **not verified**. Debug mode on a public host exposes stack traces. | `.env` (local) | Confirm `APP_DEBUG=false` on demo/production. |
| 7 | MEDIUM | Unknown slugs cause **500** errors (null row) instead of 404, leaking error behaviour/logs. | `/blog/x`, `/course/x` → 500 | Return 404 when the row is missing. |
| 8 | LOW | Page views log IP + user-agent for every hit (`page_views`, 57k+ rows) with no retention limit. | `record_page_view()` | Retention policy / anonymise IPs. |
| 9 | LOW | Hidden blog posts (`status=0`) are reachable by URL. | `BlogpageController@blogDetails` has no status check | Add `where status = 1` (or admin-preview rule). |
| 10 | LOW | Two admin tables (`users`, `tbl_admin`); only `users` is used. `tbl_admin` has 2 rows and a password column but no code reads it. | grep | Confirm and remove/lock the unused table (owner decision). |
| 11 | LOW | `storage/logs/laravel.log` is ~9 MB locally; logs may contain request data. | file size | Rotate logs. |

## Good practice already present
- Admin routes sit behind `auth.admin` middleware; session-based login. CSRF tokens are present in the 5 form views checked (`applynowpopup`, `apform`, `bookcampustourform`, `enquiry-form`, `pay-now-form`) and the admin login; `courses/appointment-form` has none **(not verified whether it submits)**. Blade output is escaped with `{{ }}` in the new partial/headers.
- Secrets are only in `.env` (not committed; `.gitignore` covers it).

## Rules when changing anything
Never weaken a control to make a feature work; never put keys/passwords in docs, commits or chat; get approval before touching authentication.
