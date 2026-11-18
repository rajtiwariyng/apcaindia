"""Demo package #3 (2026-11-18): Delhi page, blog redirects, sitemap. Code only - no database change, no new images.
Builds docs/deploy/out/deploy3.zip (files under files/<project path>). Run from the project root.
"""
import os
import zipfile

OUT = 'docs/deploy/out'
os.makedirs(OUT, exist_ok=True)
FILES = [
    'routes/web.php',
    'app/Http/Controllers/Front/AboutusController.php',
    'app/Http/Controllers/Front/SitemapController.php',
    'config/centres.php',
    'config/redirects.php',
    'resources/views/aboutus/delhi.blade.php',
]
zp = f'{OUT}/deploy3.zip'
with zipfile.ZipFile(zp, 'w', zipfile.ZIP_DEFLATED) as z:
    for f in FILES:
        z.write(f, 'files/' + f)
print(zp, os.path.getsize(zp), 'bytes;', len(FILES), 'files')
