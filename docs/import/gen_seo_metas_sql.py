"""Generate docs/import/apply_seo_metas.sql from docs/apca-metas.xlsx (approved rows only).
Insert-only: a row is skipped if tbl_seo already has that url_slug."""
import zipfile, re, html

z = zipfile.ZipFile('docs/apca-metas.xlsx')
ss = [html.unescape(re.sub(r'<[^>]+>', '', s)) for s in re.findall(r'<si>(.*?)</si>', z.read('xl/sharedStrings.xml').decode(), re.S)]
sh = z.read('xl/worksheets/sheet1.xml').decode()
rows = {}
for n, body in re.findall(r'<row [^>]*r="(\d+)"[^>]*>(.*?)</row>', sh, re.S):
    c = {}
    for ref, t, b in re.findall(r'<c r="([A-Z]+)\d+"([^>]*?)(?:/>|>(.*?)</c>)', body, re.S):
        v = re.search(r'<v>(.*?)</v>', b or '')
        if v:
            c[ref] = ss[int(v.group(1))] if 't="s"' in t else v.group(1)
    rows[int(n)] = c

# sheet row -> tbl_seo.url_slug (exact + likely matches; undecided rows and alumni are NOT applied)
M = {2: '/', 30: 'blog', 25: 'faq', 26: 'pay-now', 27: 'contact-us', 29: 'news', 21: 'career',
     20: 'accomodation', 19: 'online-registration', 31: 'message-from-founder',
     32: 'bangalore', 33: 'gurgaon', 34: 'mumbai', 35: 'delhi',
     14: 'awards-accolades', 22: 'industrial-visit', 28: 'chef-educators',
     4: 'course/advanced-diploma-in-culinary-arts',
     5: 'course/weekend-part-time-culinary-program',
     7: 'course/advanced-diploma-in-pastry-bakery-arts',
     8: 'course/weekend-part-time-pastry-program',
     9: 'course/eggless-6-week-certificate',
     11: 'course/12-weeks-intensive-course',
     12: 'course/bachelor-degree-with-specialization-in-pastry-culinary-arts'}


def q(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "''") + "'"


out = ['SET NAMES utf8mb4;']
for n, slug in M.items():
    r = rows[n]
    out.append(
        f"INSERT INTO tbl_seo (url_slug,page_name,seo_title,seo_desc,seo_keywords,created_at) "
        f"SELECT {q(slug)},{q(r['B'])},{q(r.get('C', ''))},{q(r.get('D', ''))},'',NOW() FROM DUAL "
        f"WHERE NOT EXISTS (SELECT 1 FROM tbl_seo WHERE url_slug={q(slug)});")
open('docs/import/apply_seo_metas.sql', 'w', encoding='utf8').write('\n'.join(out) + '\n')
print(len(M), 'rows')
