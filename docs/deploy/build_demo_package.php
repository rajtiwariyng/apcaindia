<?php
/**
 * Builds the demo-server package from the LOCAL database/files:
 *   docs/deploy/out/demo_seed.sql      insert-only, idempotent (NOT EXISTS guards on slug / url_slug / category)
 *   docs/deploy/out/fetch_images.sh    downloads blog images + static images server-side (no 150MB upload)
 *   docs/deploy/out/views/...          the 4 changed Blade views
 *   docs/deploy/out/deploy.zip         all of the above, small enough to upload in the panel
 * Run from project root:  php docs/deploy/build_demo_package.php
 */
$root = dirname(__DIR__, 2);
$out = __DIR__.'/out';
@mkdir($out.'/views/header', 0777, true);
@mkdir($out.'/views/footer', 0777, true);

$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$loc = new PDO('mysql:host=127.0.0.1;dbname=apcaindia;charset=utf8mb4', 'root', '', $opt);
$wp = new PDO('mysql:host=127.0.0.1;dbname=apca_blog_wp_scratch;charset=utf8mb4', 'root', '', $opt);

$q = fn ($v) => $v === null ? 'NULL' : $loc->quote((string) $v);
$sql = ["SET NAMES utf8mb4;", "START TRANSACTION;"];

// categories added by the import
foreach ($loc->query("select * from tbl_blog_category where id > 5") as $c) {
    $sql[] = "INSERT INTO tbl_blog_category (uniqueid,category_name,status,created_at) SELECT {$q($c['uniqueid'])},{$q($c['category_name'])},{$c['status']},{$q($c['created_at'])} FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tbl_blog_category WHERE category_name={$q($c['category_name'])});";
}

// imported blog posts (local ids > 12), insert-only by slug
$blogs = $loc->query("select * from tbl_blog where id > 12 order by id")->fetchAll();
foreach ($blogs as $b) {
    $sql[] = "INSERT INTO tbl_blog (uniqueid,title,blog_short_desc,description,image,category,slug,status,created_at,updated_at,ip,metatitle,metakeywords,metadesc,img_alt) "
        ."SELECT {$q($b['uniqueid'])},{$q($b['title'])},{$q($b['blog_short_desc'])},{$q($b['description'])},{$q($b['image'])},{$q($b['category'])},{$q($b['slug'])},{$b['status']},{$q($b['created_at'])},{$q($b['updated_at'])},{$q($b['ip'])},{$q($b['metatitle'])},{$q($b['metakeywords'])},{$q($b['metadesc'])},{$q($b['img_alt'])} "
        ."FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tbl_blog WHERE slug={$q($b['slug'])});";
}

// seo rows added locally = every local row whose url_slug is not in the original 15-row backup, minus the dummy row
$orig = [];
foreach (file(__DIR__.'/../backups/pre-import_tbl_blog_category_seo.sql') as $line) {
    if (str_starts_with($line, 'INSERT INTO `tbl_seo`')) {
        preg_match_all("/\((\d+),'([^']*)'/", $line, $m);
        foreach ($m[2] as $slug) { $orig[$slug] = true; }
    }
}
echo count($orig)." original seo slugs excluded
";
$n = 0;
foreach ($loc->query('select * from tbl_seo order by id') as $s) {
    if (isset($orig[$s['url_slug']]) || $s['url_slug'] === 'blog/dummy-page') { continue; }
    $sql[] = "INSERT INTO tbl_seo (url_slug,page_name,seo_title,seo_desc,seo_keywords,created_at,updated_at) SELECT {$q($s['url_slug'])},{$q($s['page_name'])},{$q($s['seo_title'])},{$q($s['seo_desc'])},{$q($s['seo_keywords'])},{$q($s['created_at'])},{$q($s['updated_at'])} FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tbl_seo WHERE url_slug={$q($s['url_slug'])});";
    $n++;
}
$sql[] = 'COMMIT;';
file_put_contents($out.'/demo_seed.sql', implode("\n", $sql)."\n");
echo count($blogs)." blog inserts, $n seo inserts, ".strlen(implode("\n", $sql))." bytes\n";

// blog image fetch script: local filename -> source URL (via WP attachment), same names as the DB column
$byslug = [];
foreach ($blogs as $b) { if ($b['image']) { $byslug[$b['slug']] = $b['image']; } }
$qq = $wp->prepare("select a.meta_value f from wp_posts p join wp_postmeta t on t.post_id=p.ID and t.meta_key='_thumbnail_id' join wp_postmeta a on a.post_id=t.meta_value and a.meta_key='_wp_attached_file' where p.post_type='post' and p.post_status='publish' and p.post_name=?");
$sh = ["#!/bin/bash", "# run from the site root: bash fetch_images.sh", "set -u", "R=\$(pwd)", "mkdir -p \$R/public/assets/upload/blog \$R/public/assets/images", "ok=0; bad=0",
       "get(){ if curl -fsSL -m 60 -o \"\$2\" \"\$1\" && [ -s \"\$2\" ]; then ok=\$((ok+1)); else rm -f \"\$2\"; bad=\$((bad+1)); echo \"FAIL \$1\"; fi; }"];
foreach ($byslug as $slug => $name) {
    $qq->execute([$slug]);
    $file = $qq->fetchColumn();
    if (! $file) { continue; }
    $url = 'https://www.apcaindia.com/blog/wp-content/uploads/'.implode('/', array_map('rawurlencode', explode('/', $file)));
    $sh[] = 'get '.escapeshellarg($url).' "$R/public/assets/upload/blog/'.str_replace('"', '', $name).'"';
}
// static images: everything in public/assets/images except the 2 logos (those come from apcaindia.com)
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root.'/public/assets/images', FilesystemIterator::SKIP_DOTS));
foreach ($it as $f) {
    $rel = str_replace('\\', '/', substr($f->getPathname(), strlen($root.'/public/assets/images/')));
    if (in_array($rel, ['apca-india-white.png', 'apca-india-blue.png'], true)) { continue; }
    $dir = dirname($rel);
    if ($dir !== '.') { $sh[] = 'mkdir -p "$R/public/assets/images/'.$dir.'"'; }
    $url = 'https://apcamalaysia.com/assets/images/'.implode('/', array_map('rawurlencode', explode('/', $rel)));
    $sh[] = 'get '.escapeshellarg($url).' "$R/public/assets/images/'.$rel.'"';
}
$sh[] = 'get https://www.apcaindia.com/images/apca-white-log.png "$R/public/assets/images/apca-india-white.png"';
$sh[] = 'get https://www.apcaindia.com/images/blue-logo.png "$R/public/assets/images/apca-india-blue.png"';
$sh[] = 'chown -R www:www $R/public/assets/upload/blog $R/public/assets/images 2>/dev/null';
$sh[] = 'echo "images ok=$ok failed=$bad"';
file_put_contents($out.'/fetch_images.sh', str_replace("\r\n", "\n", implode("\n", $sh)."\n"));
echo count($sh)." lines in fetch_images.sh\n";

foreach (['header/header', 'header/header-home', 'header/header-fixed', 'footer/footer'] as $v) {
    copy("$root/resources/views/$v.blade.php", "$out/views/$v.blade.php");
}
