# FAQ

## Data (verified 2026-11-18)
- Table `tbl_faqs` (latin1): `id, uniqueid, question, answer, home, ip, status, created_at, updated_at`. **13 rows**, all `status=1`, **4 with `home=1`**.
- Admin: **Faqs** module (`/admin/faqs/listing`, `/create`, `/create/{url?}`, `addupdate`, status toggle, delete) — controller `FaqsController`, model `Faq`. (Whether the form exposes the `home` flag as a checkbox: **not verified**.)

## Where FAQs appear
| Page | Source |
|---|---|
| `/faq` (`aboutus/faq` view) | **all** `status=1` rows, ordered by id (numbered "1. …" in the view) |
| Home page (`home/faqs_home` include) | `status=1` AND `home=1` |
| `/bangalore`, `/gurgaon`, `/mumbai`, `/delhi` (same `Home::faqs_home` include, data from `AboutusController::cityData`) | `status=1` AND `home=1` |
`/faq` also shows the banner for `page='faq'` and the partner strip. SEO row for `/faq` exists (title + description).

## Comparison with the live site (`https://www.apcaindia.com/faq.html`, checked 2026-11-18)
- Live page has **37** question/answer items (accordion `faq-1…`). The new site has **13**.
- **10** live questions already exist in the database (matched by question text, ignoring case and punctuation).
- **27 live questions are missing** from the new site (list below). **3 questions exist only on the new site**: "When are the upcoming intakes for the Advanced Diploma programs?", "What certification will I receive after completing the 9-month program?", "What career opportunities are available after graduation?".
- Status: **import not done yet** — the user asked for it on 2026-11-18 ("content live se le lo, design apna site ke according"); it was paused for this documentation task. See [STATUS.md](STATUS.md).

### Missing on the new site (27)
You are present in which all cities in India and abroad? · Which center is better - Gurgaon or Bangalore or Mumbai? · I want to study in your Malaysia Centre. How do I go about it? · What kind of courses do you offer? · I want to become a professional chef. Which course will suit me? · I want to learn food only for hobby. Would Part Time suit me? · Do you teach eggless baking? Is your course vegetarian? · Can I pay in installments? · How do I pay my fees? · Tell us more about this course? · What is the benefit of this course? · How much will the course cost and what does it include? · Who will take our classes? · Tell us a little more about your chef faculty? · When will the next batch begin? · What is the requirement to get admission and what is the eligibility required to join? · I do not know anything about food or baking. Can I take admission? · Will I get an internship after the course? · Will you guys assist in Job Placement? · Which hotels/ Restaurants/ Bakery do you have a tie-up with? · Will your institute help in bank education loan? · Are you affiliated with any university or government body? · How much fee I have to pay for City & Guilds Exam? · Any other affiliation with a government body? · Is it mandatory to appear for the C&G exam? · What happens to the product that we make in our class? · Will there be a break in 9 months course?

### Plan (insert-only, no overwrite)
1. Parse question + answer from the live page. 2. Insert the 27 missing rows into `tbl_faqs` (`uniqueid` via `random_unique_id()` format, `status=1`, `home=0`) after a table backup. 3. Existing 13 rows untouched. 4. The `/faq` view already renders every active row in the site theme — no view change needed. 5. Log in CHANGELOG; deploy to demo only after approval.
Open question for the owner: the live answers are long HTML — keep formatting as plain text or HTML? (Decide before import.)
