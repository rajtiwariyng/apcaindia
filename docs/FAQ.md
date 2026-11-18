# FAQ

## Data (verified 2026-11-18)
- Table `tbl_faqs` (latin1): `id, uniqueid, question, answer, home, ip, status, created_at, updated_at`. **40 rows** (13 original + 27 imported from the live site on 2026-11-18 — local **and demo**), all `status=1`, **4 with `home=1`** (unchanged).
- **Storage rule:** `question` is printed with `{{ }}` (Blade escapes it) → store it **raw** (`City & Guilds`). `answer` is printed with `{!! !!}` (raw HTML) → store HTML (existing answers use `<p>`, `<a>`, `&amp;`). The live import stored answers as plain text, HTML-escaped, so `&`, `<`, `>` are safe.
- Admin: **Faqs** module (`/admin/faqs/listing`, `/create`, `/create/{url?}`, `addupdate`, status toggle, delete) — controller `FaqsController`, model `Faq`. (Whether the form exposes the `home` flag as a checkbox: **not verified**.)

## Where FAQs appear
| Page | Source |
|---|---|
| `/faq` (`aboutus/faq` view) | **all** `status=1` rows, ordered by id (numbered "1. …" in the view) |
| Home page (`home/faqs_home` include) | `status=1` AND `home=1` |
| `/bangalore`, `/gurgaon`, `/mumbai`, `/delhi` (same `Home::faqs_home` include, data from `AboutusController::cityData`) | `status=1` AND `home=1` |
`/faq` also shows the banner for `page='faq'` and the partner strip. SEO row for `/faq` exists (title + description).

## Import from the live site (done 2026-11-18: local + demo)
- Live page `https://www.apcaindia.com/faq.html` has **37** items. 10 already existed (matched by question text) → **27 imported** (`status=1`, `home=0`), appended after the existing rows, so on `/faq` they appear as questions 14–40 in the live order. The original 13 rows were not touched. Total: **40**.
- Answers were imported as **plain text** (as requested): no links, bold or lists; each answer is a single paragraph; stored HTML-escaped. Copied as-is from the live page, including its own typo in "Is it mandatory to appear for the C&G exam?" ("…appear for the C& exam").
- 3 questions exist only on the new site (not on live): "When are the upcoming intakes for the Advanced Diploma programs?", "What certification will I receive after completing the 9-month program?", "What career opportunities are available after graduation?".
- Files: `docs/import/gen_live_faqs_sql.py` (builds the SQL; compare-DB argument lets you rebuild it after the import), `docs/import/apply_live_faqs.sql` (27 insert-only statements with `NOT EXISTS` guards — safe to run again), backup `docs/backups/pre-faq-import_tbl_faqs.sql` (local only).
- **Demo: deployed 2026-11-18** (13 → 40, backup `/root/apca_backup_20261118_2/tbl_faqs.sql`) — see [DEPLOYMENT.md](DEPLOYMENT.md). **Production: not done.**
- A question fix was needed during the import: the first run double-escaped `&` in 2 questions; corrected in the data and in the script.

### The 27 questions imported
You are present in which all cities in India and abroad? · Which center is better - Gurgaon or Bangalore or Mumbai? · I want to study in your Malaysia Centre. How do I go about it? · What kind of courses do you offer? · I want to become a professional chef. Which course will suit me? · I want to learn food only for hobby. Would Part Time suit me? · Do you teach eggless baking? Is your course vegetarian? · Can I pay in installments? · How do I pay my fees? · Tell us more about this course? · What is the benefit of this course? · How much will the course cost and what does it include? · Who will take our classes? · Tell us a little more about your chef faculty? · When will the next batch begin? · What is the requirement to get admission and what is the eligibility required to join? · I do not know anything about food or baking. Can I take admission? · Will I get an internship after the course? · Will you guys assist in Job Placement? · Which hotels/ Restaurants/ Bakery do you have a tie-up with? · Will your institute help in bank education loan? · Are you affiliated with any university or government body? · How much fee I have to pay for City & Guilds Exam? · Any other affiliation with a government body? · Is it mandatory to appear for the C&G exam? · What happens to the product that we make in our class? · Will there be a break in 9 months course?


## To do / ideas
- Re-order or flag more FAQs for the home page (`home=1`) from the admin Faqs module if wanted.
- If formatted answers (links, lists) are wanted later, edit them in the admin Faqs module (CKEditor/HTML).
