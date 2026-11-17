<?php
/**
 * One-off importer: WordPress blog dump (docs/apca_blog.sql) -> Laravel tbl_blog.
 *
 * Source: scratch DB `apca_blog_wp_scratch` (the dump imported as-is; never modified).
 * Target: `apcaindia` (tbl_blog, tbl_blog_category, tbl_seo) — INSERT ONLY, no updates/deletes.
 *
 * Usage:
 *   php docs/import/import_wp_blog.php              # dry run (no writes, no downloads)
 *   php docs/import/import_wp_blog.php --commit     # insert rows (transaction) + download images
 *
 * Rules (approved):
 *  - published WP `post` rows only; skip any slug already in tbl_blog (existing rows untouched)
 *  - category = first WP category (case-insensitive match to tbl_blog_category; new ones inserted)
 *  - status = 0 (hidden) — publish after review
 *  - metas from Rank Math -> tbl_blog.metatitle/metadesc/metakeywords AND a tbl_seo row 'blog/<slug>'
 *    (the admin does the same on every save; the front end reads metas from tbl_seo)
 *  - featured image downloaded to public/assets/upload/blog/ and filename stored
 */
$commit = in_array('--commit', $argv, true);
$root = dirname(__DIR__, 2);
$imgDir = $root.'/public/assets/upload/blog';
$imgBase = 'https://www.apcaindia.com/blog/wp-content/uploads/';

$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$src = new PDO('mysql:host=127.0.0.1;dbname=apca_blog_wp_scratch;charset=utf8mb4', 'root', '', $opt);
$dst = new PDO('mysql:host=127.0.0.1;dbname=apcaindia;charset=utf8mb4', 'root', '', $opt);
$dst->exec("SET SESSION sql_mode='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION'");

function wpautop_lite(string $t): string
{
    $t = preg_replace('/<!--\s*\/?wp:.*?-->\s*/s', '', $t);          // gutenberg comments
    $t = str_replace(["\r\n", "\r"], "\n", trim($t));
    if (stripos($t, '<p') === false && stripos($t, '<h') === false && stripos($t, '<ul') === false) {
        $paras = preg_split('/\n{2,}/', $t);
        $t = implode("\n", array_map(fn ($p) => '<p>'.nl2br(trim($p), false).'</p>', array_filter($paras, 'strlen')));
    }
    return $t;
}

/** true if every char survives MySQL latin1 (= cp1252) — tbl_blog.title/description are latin1 columns */
function latin1_safe(string $s): bool
{
    return mb_convert_encoding(mb_convert_encoding($s, 'Windows-1252', 'UTF-8'), 'UTF-8', 'Windows-1252') === $s;
}

$existingSlugs = array_map('strtolower', $dst->query('select slug from tbl_blog')->fetchAll(PDO::FETCH_COLUMN));
$seoSlugs = array_map('strtolower', $dst->query('select url_slug from tbl_seo')->fetchAll(PDO::FETCH_COLUMN));
$cats = [];
foreach ($dst->query('select category_name from tbl_blog_category') as $r) {
    $cats[mb_strtolower($r['category_name'])] = $r['category_name'];
}

$posts = $src->query("select ID,post_title,post_name,post_content,post_date,post_modified from wp_posts
                      where post_type='post' and post_status='publish' order by ID")->fetchAll();
$metaQ = $src->prepare("select meta_key,meta_value from wp_postmeta where post_id=? and meta_key in
                        ('rank_math_title','rank_math_description','rank_math_focus_keyword','_thumbnail_id')");
$catQ = $src->prepare("select t.name from wp_term_relationships r join wp_term_taxonomy tt using(term_taxonomy_id)
                       join wp_terms t using(term_id) where r.object_id=? and tt.taxonomy='category' order by tt.term_taxonomy_id limit 1");
$attQ = $src->prepare("select meta_key,meta_value from wp_postmeta where post_id=? and meta_key in ('_wp_attached_file','_wp_attachment_image_alt')");

$stats = ['total' => count($posts), 'skip_existing' => 0, 'to_insert' => 0, 'new_cats' => [], 'no_image' => 0,
          'latin1_issues' => [], 'long_fields' => [], 'alt_truncated' => [], 'img_ok' => 0, 'img_fail' => []];
$rows = [];
$seenSlug = [];

foreach ($posts as $p) {
    $slug = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', urldecode($p['post_name']))));
    if ($slug === '') { $slug = 'post-'.$p['ID']; }
    if (in_array($slug, $existingSlugs, true) || isset($seenSlug[$slug])) { $stats['skip_existing']++; continue; }
    $seenSlug[$slug] = true;

    $meta = [];
    $metaQ->execute([$p['ID']]);
    foreach ($metaQ as $m) { $meta[$m['meta_key']] = $m['meta_value']; }

    $catQ->execute([$p['ID']]);
    $cat = $catQ->fetchColumn() ?: 'Uncategorized';
    $key = mb_strtolower($cat);
    if (! isset($cats[$key])) { $cats[$key] = $cat; $stats['new_cats'][] = $cat; }
    $cat = $cats[$key];

    $file = $alt = null;
    if (! empty($meta['_thumbnail_id'])) {
        $attQ->execute([$meta['_thumbnail_id']]);
        foreach ($attQ as $a) {
            if ($a['meta_key'] === '_wp_attached_file') { $file = $a['meta_value']; }
            else { $alt = $a['meta_value']; }
        }
    }
    if (! $file) { $stats['no_image']++; }

    $title = html_entity_decode($p['post_title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $desc = wpautop_lite($p['post_content']);
    // description is HTML in a latin1 column: store chars outside latin1 (e.g. rupee sign) as numeric entities
    // so no schema change is needed and the rendered page is identical.
    $desc = preg_replace_callback('/./us', fn ($m) => latin1_safe($m[0]) ? $m[0] : '&#'.mb_ord($m[0]).';', $desc);
    $altTxt = $alt ? html_entity_decode($alt, ENT_QUOTES | ENT_HTML5, 'UTF-8') : null;
    if ($altTxt !== null && mb_strlen($altTxt) > 150) {          // img_alt is varchar(150)
        $stats['alt_truncated'][] = $p['ID'];
        $altTxt = rtrim(mb_substr($altTxt, 0, 150));
        $altTxt = preg_replace('/\s+\S*$/u', '', $altTxt) ?: $altTxt;
    }
    $row = [
        'wp_id' => $p['ID'], 'title' => $title, 'slug' => $slug, 'description' => $desc, 'category' => $cat,
        'file' => $file, 'img_alt' => $altTxt,
        'metatitle' => $meta['rank_math_title'] ?? null, 'metadesc' => $meta['rank_math_description'] ?? null,
        'metakeywords' => $meta['rank_math_focus_keyword'] ?? null,
        'created_at' => $p['post_date'], 'updated_at' => $p['post_modified'],
    ];
    // latin1 columns: title, description, slug, category, metatitle/metadesc/metakeywords (text, latin1)
    foreach (['title', 'description', 'metatitle', 'metadesc', 'metakeywords'] as $f) {
        if ($row[$f] !== null && ! latin1_safe($row[$f])) { $stats['latin1_issues'][] = $p['ID'].':'.$f; }
    }
    if (mb_strlen($title) > 255) { $stats['long_fields'][] = $p['ID'].':title'; }
    $rows[] = $row;
}
$stats['to_insert'] = count($rows);

echo "== Dry-run summary ==\n";
echo "WP published posts : {$stats['total']}\n";
echo "Skipped (slug exists / duplicate): {$stats['skip_existing']}\n";
echo "To insert          : {$stats['to_insert']}\n";
echo "New categories     : ".(implode(', ', $stats['new_cats']) ?: '-')."\n";
echo "Posts w/o image    : {$stats['no_image']}\n";
echo "Not latin1-safe    : ".count($stats['latin1_issues'])." ".implode(' ', array_slice($stats['latin1_issues'], 0, 20))."\n";
echo "Alt truncated to 150: ".count($stats['alt_truncated'])." ".implode(' ', $stats['alt_truncated'])."
";
echo "Title > 255        : ".count($stats['long_fields'])."\n";

if (! $commit) { echo "\n(dry run — nothing written. Re-run with --commit)\n"; exit(0); }
if ($stats['latin1_issues'] || $stats['long_fields']) { fwrite(STDERR, "\nABORT: resolve latin1/length issues first.\n"); exit(1); }

// ---- commit ---------------------------------------------------------------
@mkdir($imgDir, 0777, true);
$dst->beginTransaction();
try {
    $insCat = $dst->prepare('insert into tbl_blog_category (uniqueid,category_name,status,created_at) values (?,?,1,?)');
    foreach ($stats['new_cats'] as $c) { $insCat->execute([mt_rand(10, 100).uniqid(), $c, date('Y-m-d H:i:s')]); }

    $insBlog = $dst->prepare('insert into tbl_blog (uniqueid,title,blog_short_desc,description,image,category,slug,status,created_at,updated_at,
        metatitle,metakeywords,metadesc,img_alt) values (?,?,NULL,?,?,?,?,0,?,?,?,?,?,?)');
    $insSeo = $dst->prepare("insert into tbl_seo (url_slug,page_name,seo_title,seo_desc,seo_keywords,created_at) values (?, 'blog', ?,?,?,?)");

    foreach ($rows as $r) {
        $image = null;
        if ($r['file']) {
            $name = substr(uniqid().'_'.preg_replace('/[^A-Za-z0-9._-]/', '_', basename($r['file'])), 0, 99);
            $ch = curl_init($imgBase.str_replace('%2F', '/', rawurlencode($r['file'])));
            curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true, CURLOPT_TIMEOUT => 60]);
            $data = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($code === 200 && $data !== false && strlen($data) > 0 && file_put_contents("$imgDir/$name", $data) !== false) {
                $image = $name; $stats['img_ok']++;
            } else {
                $stats['img_fail'][] = $r['wp_id'].' '.$r['file'].' ('.$code.')';
            }
        }
        $insBlog->execute([mt_rand(10, 100).uniqid(), $r['title'], $r['description'], $image, $r['category'], $r['slug'],
            $r['created_at'], $r['updated_at'], $r['metatitle'], $r['metakeywords'], $r['metadesc'], $r['img_alt']]);
        if (! in_array('blog/'.$r['slug'], $seoSlugs, true)) {
            $insSeo->execute(['blog/'.$r['slug'], $r['metatitle'], $r['metadesc'], $r['metakeywords'], date('Y-m-d H:i:s')]);
        }
    }
    $dst->commit();
} catch (Throwable $e) {
    $dst->rollBack();
    fwrite(STDERR, 'ROLLED BACK: '.$e->getMessage()."\n");
    exit(1);
}
echo "\nCOMMITTED. Inserted {$stats['to_insert']} posts; images ok {$stats['img_ok']}, failed ".count($stats['img_fail'])."\n";
foreach ($stats['img_fail'] as $f) { echo "  image fail: $f\n"; }
