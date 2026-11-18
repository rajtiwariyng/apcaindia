<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * /sitemap.xml — generated from the live data, so it never goes stale.
 *
 * Lists only URLs that return 200 (verified 2026-11-18). Deliberately NOT listed: /footer, /header, /search-posts,
 * /categories/*, /blog-listing (duplicate of /blog), /news-details (unlinked), and the pages whose view files are
 * missing (500): /industrial-visit, /recipes-and-inspiration. Add them back once those pages exist. Hidden content (status != 1) is never listed.
 */
class SitemapController extends Controller
{
    /** Static public pages (path => priority). */
    private const STATIC_PAGES = [
        '' => '1.0',
        'courses' => '0.8', 'bangalore' => '0.9', 'gurgaon' => '0.9', 'mumbai' => '0.9', 'delhi' => '0.9',
        'about-us' => '0.7', 'faculty' => '0.6', 'chef-educators' => '0.7', 'apca-alumni' => '0.6',
        'awards-accolades' => '0.6', 'message-from-founder' => '0.5', 'achivements' => '0.5', 'achivements-gallery' => '0.4',
        'gallery' => '0.6', 'news' => '0.5', 'blog' => '0.8', 'faq' => '0.7', 'contact-us' => '0.8',
        'admission' => '0.7', 'online-registration' => '0.7', 'program-application' => '0.6', 'program-flyers' => '0.5',
        'academic-intake-calendar' => '0.6', 'apca-programs' => '0.6', 'academy-resource' => '0.6',
        'international-paid-internship' => '0.6', 'accomodation' => '0.5', 'career' => '0.5', 'career-opportunities' => '0.5',
        'recipe-and-inspiration' => '0.4', 'visit-the-academy' => '0.6', 'pay-now' => '0.5',
        'privacy-policy' => '0.2', 'terms-and-conditions' => '0.2',
    ];

    public function index()
    {
        $base = rtrim(url('/'), '/');
        $urls = [];

        foreach (self::STATIC_PAGES as $path => $priority) {
            $urls[] = [$base.($path === '' ? '/' : '/'.$path), null, $priority];
        }

        foreach (DB::table('courses')->where('status', 1)->get(['slug', 'updated_at']) as $c) {
            $urls[] = [$base.'/course/'.$c->slug, $c->updated_at, '0.8'];
        }
        foreach (DB::table('tbl_intprogram_page')->where('status', 1)->get(['slug', 'updated_at']) as $p) {
            $urls[] = [$base.'/international-paid-internship/'.$p->slug, $p->updated_at, '0.5'];
        }
        foreach (DB::table('tbl_blog')->where('status', 1)->orderByDesc('id')->get(['slug', 'updated_at', 'created_at']) as $b) {
            $urls[] = [$base.'/blog/'.$b->slug, $b->updated_at ?: $b->created_at, '0.6'];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($urls as [$loc, $lastmod, $priority]) {
            $xml .= '  <url><loc>'.htmlspecialchars($loc, ENT_XML1 | ENT_QUOTES, 'UTF-8').'</loc>';
            if ($lastmod) {
                $xml .= '<lastmod>'.date('Y-m-d', strtotime((string) $lastmod)).'</lastmod>';
            }
            $xml .= '<priority>'.$priority.'</priority></url>'."\n";
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
