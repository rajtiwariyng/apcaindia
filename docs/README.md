# APCA India — Project Docs (start here)

Last verified against the code and local database: **2026-11-18**. Everything in these files was read from the code, routes, database or live site — nothing is assumed. Anything that could **not** be verified is marked **(not verified)**.

## How to use these docs
1. Read **[STATUS.md](STATUS.md)** first — what is built, what is pending, known bugs, uncommitted work.
2. Then the topic file you need:

| File | What it answers |
|---|---|
| [PROJECT.md](PROJECT.md) | What the site is, roles, integrations, business rules |
| [ARCHITECTURE.md](ARCHITECTURE.md) | Stack, request flow, folder map, view namespaces, shared data, uploads, auth |
| [PAGES.md](PAGES.md) | Every public URL: controller, view, data source, static/dynamic, SEO status |
| [DYNAMIC-VS-STATIC.md](DYNAMIC-VS-STATIC.md) | What an editor can change in the admin vs what is hard-coded in code |
| [ADMIN.md](ADMIN.md) | Admin panel: login, every module, tables, upload folders |
| [BLOG.md](BLOG.md) | Blog data, admin flow, front behaviour, WordPress import, known issues |
| [FAQ.md](FAQ.md) | FAQ data, where FAQs show, live-site comparison (27 missing) |
| [SEO.md](SEO.md) | How titles/descriptions work (`tbl_seo`), which pages have them |
| [DATABASE.md](DATABASE.md) | Tables, row counts, what each drives, charset notes |
| [DEVELOPMENT.md](DEVELOPMENT.md) | Run locally, commands, scripts |
| [DEPLOYMENT.md](DEPLOYMENT.md) | Demo server facts, how it was deployed, rollback |
| [SECURITY.md](SECURITY.md) | Verified security risks |
| [TESTING.md](TESTING.md) | Test state and why most tests fail locally |
| [CHANGELOG.md](CHANGELOG.md) | Dated list of changes — **update on every change** |
| [changes/CR-001.md](changes/CR-001.md) | Detailed change record (blog import, SEO, deploy) |

## Rules for keeping these docs correct
- Change code → update the matching doc **and** [CHANGELOG.md](CHANGELOG.md) in the same task.
- A new page, admin module, table or route must be added to PAGES / ADMIN / DATABASE.
- Never write a fact here you did not verify; mark it **(not verified)**.
- Never put passwords, keys or tokens in docs.

## Other files in `docs/`
- `apca_blog.sql` — WordPress blog dump (source of the import). Not committed (too large).
- `apca-metas.xlsx` — SEO title/description sheet (36 rows).
- `import/` — one-off import scripts (blog, SEO sheet, centre config). `deploy/` — demo deploy package builder. `backups/` — SQL backups (not committed).
