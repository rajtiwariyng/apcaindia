"""Generate config/centres.php from the live-site extract (centres_utf8.json made from apcaindia.com/{bangalore,gurgaon,mumbai}.html).
Text is copied from the live pages; only the three obvious date typos are normalised (see TYPO_FIX).
Usage:  python docs/import/gen_centres_config.py <path-to-centres_utf8.json>
"""
import json
import re
import sys

d = json.load(open(sys.argv[1], encoding='utf8'))

C = {  # course slug -> new route
    'cf': ('/course/advanced-diploma-in-culinary-arts', 'advanced-diploma-in-culinary-arts'),
    'cp': ('/course/weekend-part-time-culinary-program', 'weekend-part-time-culinary-program'),
    'pf': ('/course/advanced-diploma-in-pastry-bakery-arts', 'advanced-diploma-in-pastry-bakery-arts'),
    'pp': ('/course/weekend-part-time-pastry-program', 'weekend-part-time-pastry-program'),
    'ba': ('/course/bachelor-degree-with-specialization-in-pastry-culinary-arts', 'bachelor-degree-with-specialization-in-pastry-culinary-arts'),
    'i12': ('/course/12-weeks-intensive-course', '12-weeks-intensive-course'),
    'mc': ('/courses', None),  # live "Master Class" has no page on the new site
}
FT = ['Duration: 9 Months', 'Days: Monday - Friday', 'Timing: 9:00am-5:00pm']
PT = ['Duration: 12 Week Session', 'Days: Saturday-Sunday', 'Timing: 9:00am-5:00pm']
DEG3 = ['Duration: 3 years', 'Days: Monday - Friday', 'Timing: 9:00 am - 5:00 pm']

# only these obvious typos are corrected in the live dates
TYPO_FIX = {'23th August 2027': '23rd August 2027', '20th february 2027': '20th February 2027', '22th Feb 2027': '22nd Feb 2027'}

def course(key, title, lines):
    return {'title': title, 'lines': lines, 'url': C[key][0], 'slug': C[key][1]}

def img_list(city, names):
    return [f'assets/images/centres/{city}/{n}' for n in names]

def intakes(pairs):
    return [{'name': n, 'date': TYPO_FIX.get(dt, dt)} for n, dt in pairs]

b, g, m, dl = d['bangalore'], d['gurgaon'], d['mumbai'], d['delhi']
cfg = {
    'bangalore': {
        'title': b['h1'], 'intro': b['paras'][0:3], 'video': 'VaB7_wzmPJ0',
        'media_image': None,
        'sections': [
            {'heading': None, 'paras': [b['paras'][3]], 'list': []},
            {'heading': 'Rewards & Recognition', 'paras': [b['paras'][4]], 'list': b['li']},
            {'heading': None, 'paras': [b['paras'][5]], 'list': []},
        ],
        'courses_intro': b['courses_intro'][0],
        'courses': [
            course('cf', 'Culinary Advanced Diploma Program', FT),
            course('cp', 'Culinary Part Time Program', PT),
            course('pf', 'Pastry Advanced Diploma Program', FT),
            course('pp', 'Pastry Part Time Program', PT),
            course('ba', "Bachelor's Degree In Tourism Studies, Specialization in Pastry & Culinary Arts",
                   ['Duration: 3 Years', 'Kitchen Session: 9 months Pastry & 9 months Culinary']),
            course('mc', 'Master Class', []),
        ],
        'intakes': intakes([('Full Time Pastry & Bakery', '30th November 2026'), ('Full Time Culinary', '30th November 2026'),
                            ('Part Time Pastry & Bakery', '28th November 2026'), ('Part Time Culinary', '20th february 2027'),
                            ("Bachelor's Degree In Tourism Studies, Specialization in Pastry & Culinary Arts", '23th August 2027')]),
        'gallery': img_list('bangalore', ['1.jpg', '2.jpg', '3.jpg']),
    },
    'gurgaon': {
        'title': g['h1'], 'intro': g['paras'][0:5], 'video': None,
        'media_image': 'assets/images/centres/gurgaon/1.jpg',
        'sections': [
            {'heading': 'Location & Surroundings', 'paras': [g['paras'][5]], 'list': []},
            {'heading': 'Convenience & Connectivity', 'paras': [g['paras'][6]], 'list': []},
            {'heading': 'State-of-the-Art Infrastructure', 'paras': [g['paras'][7]], 'list': []},
            {'heading': 'A Legacy of Success', 'paras': [g['paras'][8]], 'list': []},
            {'heading': 'Notable Achievements', 'paras': [g['paras'][9]], 'list': g['li']},
            {'heading': None, 'paras': [g['paras'][10]], 'list': []},
        ],
        'courses_intro': None,
        'courses': [
            course('pf', 'Pastry Advanced Diploma Program', FT),
            course('pp', 'Pastry Part Time Program', PT),
            course('cf', 'Culinary Advanced Diploma Program', FT),
            course('ba', '3 years degree course with specialization in Culinary & Pastry arts', DEG3),
        ],
        'intakes': intakes([('Full Time Pastry & Bakery', '23rd Nov. 2026'), ('Part Time Pastry & Bakery', '5th Sep 2026'),
                            ('Full Time Culinary', '23rd Nov. 2026'), ('6 Weeks Eggless Certificate', '-'),
                            ('Part Time Culinary', '5th Sep 2026'), ('12 Week Intensive course', '22th Feb 2027'),
                            ('3 years degree course with specialization in Culinary & Pastry arts', '23rd August 2027')]),
        'gallery': img_list('gurgaon', ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg']),
    },
    'delhi': {
        'title': dl['h1'], 'intro': dl['paras'][0:4], 'video': None,
        'media_image': 'assets/images/centres/gurgaon/1.jpg',  # live Delhi page shows the same photos as Gurgaon
        'sections': [
            {'heading': None, 'paras': [dl['paras'][4]], 'list': []},
        ],
        'courses_intro': None,
        'courses': [
            course('pf', 'Pastry Advanced Diploma Program', FT),
            course('pp', 'Pastry Part Time Program', PT),
            course('cf', 'Culinary Advanced Diploma Program', FT),
            course('ba', '3 years degree course with specialization in Culinary & Pastry arts', DEG3),
        ],
        # dates copied as-is from the live page (already in the past on 2026-11-18)
        'intakes': intakes([('Full Time Pastry & Bakery', '25th May 2026'), ('Part Time Pastry & Bakery', '23rd May 2026'),
                            ('Full Time Culinary', '25th May 2026'), ('6 Weeks Eggless Certificate', '9th March 2026'),
                            ('Part Time Culinary', '23rd May 2026'),
                            ('3 years degree course with specialization in Culinary & Pastry arts', '17th August 2026')]),
        'gallery': img_list('gurgaon', ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg']),
    },
    'mumbai': {
        'title': m['h1'], 'intro': m['paras'][0:2], 'video': None,
        'media_image': 'assets/images/centres/mumbai/1.png',
        'sections': [
            {'heading': 'Why Choose APCA Mumbai?', 'paras': [m['paras'][2]], 'list': m['li'][0:6], 'list_first': True},
            {'heading': 'Rewards & Recognition', 'paras': [m['paras'][3]], 'list': m['li'][6:]},
            {'heading': None, 'paras': [m['paras'][4]], 'list': []},
        ],
        'courses_intro': None,
        'courses': [
            course('pf', 'Pastry Advanced Diploma Program', FT),
            course('pp', 'Pastry Part Time Program', PT),
            course('cf', 'Culinary Advanced Diploma Program', FT),
            course('cp', 'Culinary Part Time Program', PT),
            course('i12', '12 Week Intensive course', ['Duration: 12 Weeks', 'Days: Monday - Friday', 'Timing: 10:00am-3:00pm']),
            course('ba', '3 years degree course with specialization in Culinary & Pastry arts', DEG3),
        ],
        'intakes': intakes([('Full Time Pastry & Bakery', '23rd November 2026'), ('Part Time Pastry & Bakery', '12th Sep 2026'),
                            ('Full Time Culinary', '12th Feb 2027'), ('Part Time Culinary', '12th Sep 2026'),
                            ('12 Week Intensive course', '15th Feb 2027'),
                            ('3 years degree course with specialization in Culinary & Pastry arts', '17th Aug 2026'),
                            ('Egg Free Baking weekend course', '28th Nov 2026')]),
        'gallery': img_list('mumbai', ['1.png', '2.png', '3.png', '8.jpeg', '9.jpeg', '10.jpeg', '11.jpeg']),
    },
}


def php(v, ind=0):
    pad = '    ' * ind
    if v is None:
        return 'null'
    if isinstance(v, bool):
        return 'true' if v else 'false'
    if isinstance(v, (int, float)):
        return str(v)
    if isinstance(v, str):
        return "'" + v.replace('\\', '\\\\').replace("'", "\\'") + "'"
    if isinstance(v, list):
        if not v:
            return '[]'
        return '[\n' + ''.join(f"{pad}    {php(x, ind + 1)},\n" for x in v) + pad + ']'
    return '[\n' + ''.join(f"{pad}    {php(k)} => {php(x, ind + 1)},\n" for k, x in v.items()) + pad + ']'


head = """<?php

/*
|--------------------------------------------------------------------------
| City centre pages (bangalore / gurgaon / mumbai)
|--------------------------------------------------------------------------
| Content copied from the live site (apcaindia.com/{city}.html), rendered by
| resources/views/aboutus/partials/centre-body.blade.php. Generated by
| docs/import/gen_centres_config.py — edit here (or regenerate) to change the pages.
| Upcoming-intake dates are static text, as on the live site; update them here.
*/

return """
open('config/centres.php', 'w', encoding='utf8', newline='\n').write(head + php(cfg) + ";\n")
print('config/centres.php written')
