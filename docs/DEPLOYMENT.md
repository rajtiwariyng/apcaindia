# Deployment

The original production cutover plan (Laravel 12 replacing the legacy Laravel 7 app, PHP 8.0 → 8.3 requirement, rollback) is in the **root file `DEPLOYMENT.md`**. This file records what was actually done and verified.

## Demo server (verified 2026-11-18)
| Item | Value |
|---|---|
| URL | https://demo.karmatech.in |
| Server | aaPanel (Ubuntu 24), 7 PHP sites on one host, Apache 2.4, PHP 8.3 |
| Site root | `/www/wwwroot/demo.karmatech.in` (no `.git`; files owned by `www`) |
| Database | `sql_demo_karmatech_in` (host 127.0.0.1) — credentials are in the site's `.env` (never copy them into docs/chat) |
| Panel access | aaPanel web login (session link in the URL, expires). A root terminal is available inside the panel. |
| Panel backup | the site had 1 older panel backup before 2026-11-18 |

## What was deployed on 2026-11-18 (all from local work of 2026-11-17)
Method: a small package built by `docs/deploy/build_demo_package.php` (insert-only SQL + image-fetch script + 4 views) uploaded as `deploy.zip` via the panel, then run in the panel terminal. Images were downloaded server-side from the live sites instead of uploading ~150 MB.
1. **Backups first** → `/root/apca_backup_20261118/tables.sql` (tbl_blog, tbl_blog_category, tbl_seo) and `/root/apca_backup_20261118/views/` (4 original views).
2. **DB (insert-only, `NOT EXISTS` guards):** +239 blog posts (published), +1 category (`Pastry School`), +264 `tbl_seo` rows. Result: tbl_blog 10 → 249 (242 live), categories 5 → 6, tbl_seo 15 → 279.
3. **Images:** 358 fetched (blog images into `public/assets/upload/blog/`, static images into `public/assets/images/`), 0 failed.
4. **Views replaced:** `header/header.blade.php`, `header-home`, `header-fixed` (title + meta tags), `footer/footer.blade.php` (white logo). View cache cleared as user `www` (`sudo -u www php artisan view:clear`).
5. **Cleanup:** `deploy.zip` removed from the site root.
6. **Verified over HTTP:** `/`, `/faq`, `/bangalore`, `/blog`, a blog post → 200 with expected titles; `/blog` lists 242 posts; logos/icons/blog image → 200.
Not done on demo: removal of the empty `blog/dummy-page` SEO row.

## Second deployment — 2026-11-18 (FAQs + centre pages + footer)
Package: `docs/deploy/build_demo_package_2.py` → `deploy2.zip` (22 KB; SQL + 7 code files + an image-fetch script), uploaded through the panel and run in the panel terminal.
1. **Backups first** → `/root/apca_backup_20261118_2/tbl_faqs.sql` and `/root/apca_backup_20261118_2/files/…` (the 5 files that were replaced). Before overwriting, the demo's 5 files were checksum-matched (CR-stripped md5) against the local baseline — identical, so nothing on the server was lost.
2. **DB (insert-only, `NOT EXISTS`):** `tbl_faqs` 13 → **40** (27 live-site FAQs, plain text); `home=1` still 4.
3. **Code copied** (owner `www`): `app/Http/Controllers/Front/AboutusController.php`, `config/centres.php` (new), `resources/views/aboutus/{bangalore,gurgaon,mumbai}.blade.php`, `resources/views/aboutus/partials/centre-body.blade.php` (new), `resources/views/footer/footer.blade.php`.
4. **Images:** 16 centre photos downloaded server-side into `public/assets/images/centres/{bangalore,gurgaon,mumbai}/` (16 ok, 0 failed).
5. `php -l` OK on the controller and config; `sudo -u www php artisan config:clear` + `view:clear`; `deploy2.zip` removed.
6. **Verified over HTTP:** `/`, `/faq`, `/bangalore`, `/gurgaon`, `/mumbai`, `/delhi`, `/blog` → 200 with expected titles; `/faq` lists items 1–40 (no double-escaped `&amp;amp;`); each centre page shows its course cards, intakes, gallery (Bangalore also the YouTube embed) and the APPLY NOW button; footer shows Bangalore/Gurugram/Mumbai/Delhi (internal) and Malaysia → apcamalaysia.com; centre images → 200.

## State of the demo vs local (2026-11-18)
The demo now matches the local code and data except: the empty `blog/dummy-page` SEO row (still on demo), `docs/` (not deployed), and anything done after this entry. Production: untouched.

## Rollback (demo) — first deployment
```bash
cd /www/wwwroot/demo.karmatech.in
export MYSQL_PWD=<from .env>; mysql -h127.0.0.1 -u<user> sql_demo_karmatech_in < /root/apca_backup_20261118/tables.sql
cp /root/apca_backup_20261118/views/header*.php resources/views/header/ ; cp /root/apca_backup_20261118/views/footer.blade.php resources/views/footer/
sudo -u www php artisan view:clear
```
(Restoring `tables.sql` also removes the imported posts. Downloaded blog images can stay.)

## Production
Not deployed. Before any production change: backup, dry run of importers, explicit approval. PHP on production was 8.0 per the root `DEPLOYMENT.md` — Laravel 12 needs 8.2+ **(not re-verified)**.

## Deploy checklist (use every time)
1. Back up the tables/files you will touch. 2. Insert-only SQL with existence guards. 3. Copy changed files; `chown www:www`. 4. `sudo -u www php artisan view:clear` (and `config:clear` if `.env`/config changed). 5. Verify URLs. 6. Log it in [CHANGELOG.md](CHANGELOG.md) and update this file.

## Rollback — second deployment
```bash
cd /www/wwwroot/demo.karmatech.in; export MYSQL_PWD=<from .env>
mysql -h127.0.0.1 -u<user> sql_demo_karmatech_in < /root/apca_backup_20261118_2/tbl_faqs.sql   # back to 13 FAQs
cp -r /root/apca_backup_20261118_2/files/* .                                                    # restore the 5 original files
rm -f config/centres.php; rm -rf resources/views/aboutus/partials                              # remove the new files
sudo -u www php artisan config:clear; sudo -u www php artisan view:clear
```
