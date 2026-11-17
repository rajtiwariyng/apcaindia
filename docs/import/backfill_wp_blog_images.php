<?php
/**
 * Backfill featured images for rows imported by import_wp_blog.php (image IS NULL only).
 * PHP's curl has no CA bundle on this XAMPP, so downloads shell out to curl.exe.
 * Updates tbl_blog.image only; never touches other columns or other rows.
 */
$root = dirname(__DIR__, 2);
$imgDir = $root.'/public/assets/upload/blog';
$base = 'https://www.apcaindia.com/blog/wp-content/uploads/';
$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$src = new PDO('mysql:host=127.0.0.1;dbname=apca_blog_wp_scratch;charset=utf8mb4', 'root', '', $opt);
$dst = new PDO('mysql:host=127.0.0.1;dbname=apcaindia;charset=utf8mb4', 'root', '', $opt);
@mkdir($imgDir, 0777, true);

$rows = $src->query("select p.ID, p.post_name, a.meta_value file from wp_posts p
  join wp_postmeta t on t.post_id=p.ID and t.meta_key='_thumbnail_id'
  join wp_postmeta a on a.post_id=t.meta_value and a.meta_key='_wp_attached_file'
  where p.post_type='post' and p.post_status='publish' order by p.ID")->fetchAll();
$sel = $dst->prepare('select id from tbl_blog where slug=? and image is null');
$upd = $dst->prepare('update tbl_blog set image=? where id=? and image is null');
$ok = $fail = 0;
foreach ($rows as $r) {
    $slug = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', urldecode($r['post_name']))));
    $sel->execute([$slug]);
    $id = $sel->fetchColumn();
    if (! $id) { continue; }
    $name = substr(uniqid().'_'.preg_replace('/[^A-Za-z0-9._-]/', '_', basename($r['file'])), 0, 99);
    $path = "$imgDir/$name";
    $url = $base.implode('/', array_map('rawurlencode', explode('/', $r['file'])));
    exec('curl -fsSL -m 60 -o '.escapeshellarg($path).' '.escapeshellarg($url).' 2>&1', $out, $code);
    if ($code === 0 && is_file($path) && filesize($path) > 0 && @getimagesize($path) !== false) {
        $upd->execute([$name, $id]); $ok++;
    } else {
        @unlink($path); $fail++; echo "FAIL {$r['ID']} {$r['file']} (curl $code)\n";
    }
}
echo "images ok: $ok, failed: $fail\n";
