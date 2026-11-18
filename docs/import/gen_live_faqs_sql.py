"""Build insert-only SQL for the FAQs that exist on the live site but not in tbl_faqs.

Source : live page saved as HTML (https://www.apcaindia.com/faq.html)  -> argv[1]
Output : SQL file                                                      -> argv[2]
Answers are imported as PLAIN TEXT: tags, links and bold are dropped, bullets become "- item" lines.
tbl_faqs.answer is printed with {!! !!} on the site, so the text is stored HTML-escaped (& < >), line breaks as <br>,
and characters outside latin1 (the column charset) as numeric entities. Questions are stored raw (the view escapes them).
Existing questions are matched ignoring case/punctuation and are never touched or duplicated.
Usage: python docs/import/gen_live_faqs_sql.py <live_faq.html> <out.sql> [db-to-compare-against, default apcaindia]
To rebuild the SQL after the import already ran, compare against a DB holding the pre-import backup (docs/backups/pre-faq-import_tbl_faqs.sql).
"""
import html
import re
import subprocess
import sys

src, out = sys.argv[1], sys.argv[2]
db = sys.argv[3] if len(sys.argv) > 3 else 'apcaindia'
s = open(src, encoding='utf8', errors='ignore').read()
s = re.sub(r'<(script|style)[^>]*>.*?</\1>', '', s, flags=re.S)
s = re.sub(r'<!--.*?-->', '', s, flags=re.S)


def norm(t):
    return re.sub(r'[^a-z0-9]', '', t.lower())


def flat(x):
    return ' '.join(html.unescape(re.sub(r'<[^>]+>', ' ', x)).split())


def to_text(body):
    b = re.sub(r'<\s*br\s*/?>', '\n', body, flags=re.I)
    b = re.sub(r'</\s*(p|div|h\d|ul|ol|table|tr)\s*>', '\n\n', b, flags=re.I)
    b = re.sub(r'<\s*li[^>]*>', '\n- ', b, flags=re.I)
    b = re.sub(r'<[^>]+>', '', b)
    b = html.unescape(b).replace('\xa0', ' ')
    lines = [re.sub(r'[ \t]+', ' ', ln).strip() for ln in b.split('\n')]
    t = '\n'.join(lines)
    t = re.sub(r'\n{3,}', '\n\n', t).strip()
    return t


def latin1_safe(ch):
    try:
        ch.encode('cp1252')
        return True
    except UnicodeEncodeError:
        return False


def store(t):
    t = t.replace('&', '&amp;').replace('<', '&lt;').replace('>', '&gt;')
    t = t.replace('\n', '<br>')
    return ''.join(c if latin1_safe(c) else '&#%d;' % ord(c) for c in t)


def q(v):
    return "'" + v.replace('\\', '\\\\').replace("'", "''") + "'"


live = []
for m in re.finditer(r'<button[^>]*data-target="#(faq-\d+)"[^>]*>(.*?)</button>', s, re.S):
    fid = m.group(1)
    ques = re.sub(r'^\d+\s*', '', flat(m.group(2)))
    bm = re.search(r'<div id="%s" class="collapse"[^>]*>\s*<div class="card-body">(.*?)</div>\s*</div>' % fid, s, re.S)
    if not bm:
        print('NO ANSWER BLOCK for', fid)
        continue
    live.append((ques, to_text(bm.group(1))))

res = subprocess.run(['C:/xampp/mysql/bin/mysql.exe', '-uroot', '-N', '--default-character-set=utf8mb4', db, '-e',
                      'select question from tbl_faqs'], capture_output=True, text=True, encoding='utf8')
existing = {norm(flat(l)) for l in res.stdout.replace('\r', '').split('\n') if l.strip()}
missing = [(qq, aa) for qq, aa in live if norm(qq) not in existing]
print('live items:', len(live), '| existing in DB:', len(live) - len(missing), '| to insert:', len(missing))

lines = ['SET NAMES utf8mb4;', 'START TRANSACTION;']
for qq, aa in missing:
    sq, sa = qq, store(aa)  # question is printed with {{ }} (escaped by Blade) -> store RAW; answer is printed with {!! !!} -> store escaped
    uid = "CONCAT(FLOOR(10 + RAND()*91), SUBSTRING(MD5(RAND()), 1, 13))"
    lines.append("INSERT INTO tbl_faqs (uniqueid, question, answer, home, ip, status, created_at, updated_at) "
                 f"SELECT {uid}, {q(sq)}, {q(sa)}, 0, NULL, 1, NOW(), NOW() FROM DUAL "
                 f"WHERE NOT EXISTS (SELECT 1 FROM tbl_faqs WHERE question = {q(sq)});")
lines.append('COMMIT;')
open(out, 'w', encoding='utf8', newline='\n').write('\n'.join(lines) + '\n')
for qq, aa in missing[:3]:
    print('--', qq.encode('ascii', 'replace').decode()[:70], '|', aa[:110].replace('\n', ' / ').encode('ascii', 'replace').decode())
print('longest answer chars:', max((len(a) for _, a in missing), default=0))
