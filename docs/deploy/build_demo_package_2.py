"""Demo package #2 (2026-11-18): FAQ import + rebuilt centre pages + footer links.
Builds docs/deploy/out/deploy2.zip containing:
  apply_live_faqs.sql        insert-only FAQs (see docs/import/gen_live_faqs_sql.py)
  fetch_centre_images.sh     downloads the 16 centre photos server-side
  files/<project paths>      the changed code files (copied to the site root on the server)
Run from the project root:  python docs/deploy/build_demo_package_2.py
"""
import os
import zipfile

OUT = 'docs/deploy/out'
os.makedirs(OUT, exist_ok=True)

FILES = [
    'app/Http/Controllers/Front/AboutusController.php',
    'config/centres.php',
    'resources/views/aboutus/bangalore.blade.php',
    'resources/views/aboutus/gurgaon.blade.php',
    'resources/views/aboutus/mumbai.blade.php',
    'resources/views/aboutus/partials/centre-body.blade.php',
    'resources/views/footer/footer.blade.php',
]

IMG = {
    'bangalore': [('1.jpg', 'https://ik.imagekit.io/uq2abzttxf/img/bangalore/1.jpg'),
                  ('2.jpg', 'https://ik.imagekit.io/uq2abzttxf/img/bangalore/2.jpg'),
                  ('3.jpg', 'https://ik.imagekit.io/uq2abzttxf/img/bangalore/3.jpg')],
    'gurgaon': [(f'{i}.jpg', f'https://ik.imagekit.io/uq2abzttxf/img/gurgaon/{i}.jpg') for i in range(1, 7)],
    'mumbai': [('1.png', 'https://ik.imagekit.io/apca/img/mumbai/1.png'),
               ('2.png', 'https://ik.imagekit.io/apca/img/mumbai/2.png'),
               ('3.png', 'https://ik.imagekit.io/ksrunnjq7/img/mumbai/3.png'),
               ('8.jpeg', 'https://ik.imagekit.io/apca/img/mumbai/8.jpeg'),
               ('9.jpeg', 'https://ik.imagekit.io/ksrunnjq7/img/mumbai/9.jpeg'),
               ('10.jpeg', 'https://ik.imagekit.io/apca/img/mumbai/10.jpeg'),
               ('11.jpeg', 'https://ik.imagekit.io/apca/img/mumbai/11.jpeg')],
}
sh = ['#!/bin/bash', '# run from the site root', 'R=$(pwd); ok=0; bad=0',
      'get(){ if curl -fsSL -m 60 -o "$2" "$1" && [ -s "$2" ]; then ok=$((ok+1)); else rm -f "$2"; bad=$((bad+1)); echo "FAIL $1"; fi; }']
for city, items in IMG.items():
    sh.append(f'mkdir -p "$R/public/assets/images/centres/{city}"')
    for name, url in items:
        sh.append(f'get "{url}" "$R/public/assets/images/centres/{city}/{name}"')
sh.append('chown -R www:www "$R/public/assets/images/centres"')
sh.append('echo "centre images ok=$ok failed=$bad"')
open(f'{OUT}/fetch_centre_images.sh', 'w', encoding='utf8', newline='\n').write('\n'.join(sh) + '\n')

zp = f'{OUT}/deploy2.zip'
with zipfile.ZipFile(zp, 'w', zipfile.ZIP_DEFLATED) as z:
    z.write('docs/import/apply_live_faqs.sql', 'apply_live_faqs.sql')
    z.write(f'{OUT}/fetch_centre_images.sh', 'fetch_centre_images.sh')
    for f in FILES:
        z.write(f, 'files/' + f)
print(zp, os.path.getsize(zp), 'bytes;', len(FILES), 'code files;', sum(len(v) for v in IMG.values()), 'images')
