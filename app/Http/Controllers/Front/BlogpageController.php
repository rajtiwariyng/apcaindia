<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Public: blog listing/detail, search, and int-program page detail. Ported from
 * the legacy Blogpage\BlogpageController.
 *
 * BUG FIX (flagged): legacy blogDetails($slug) referenced an undefined $request
 * when logging the page view (it would throw). A Request param is added here so
 * the detail page works.
 */
class BlogpageController extends Controller
{
    public function blog(Request $request)
    {
        $page = $request->segment(count($request->segments()));

        $data['banner'] = DB::table('banner_videos')->where('page', $page)->where('status', 1)->orderBy('id', 'asc')->first();
        $data['blogs'] = DB::table('tbl_blog')->orderBy('id', 'desc')->where('status', '=', 1)->get();
        $data['categories'] = DB::table('tbl_blog_category')->where('status', 1)->orderByDesc('id')->pluck('category_name');
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();

        record_page_view($request);

        return view('Blogpage::blog', compact('data'));
    }

    public function blogDetails(Request $request, $slug)
    {
        $blog = DB::table('tbl_blog')->where('slug', '=', $slug)->first();
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();
        $data['LatestBlogs'] = DB::table('tbl_blog')->orderBy('id', 'desc')->where('status', '=', 1)->limit(2)->get();

        record_page_view($request);

        return view('Blogpage::blogDetail', compact('blog', 'data'));
    }

    public function search(Request $request)
    {
        $term = $request->get('term');

        $data['blogs'] = DB::table('tbl_blog')->where('title', 'like', '%'.$term.'%')
            ->orWhere('blog_short_desc', 'like', '%'.$term.'%')
            ->take(10)
            ->get();

        return view('Blogpage::blog', compact('data', 'term'));
    }

    public function intprogrampageDetails(Request $request, $slug)
    {
        $blog = DB::table('tbl_intprogram_page')->where('slug', '=', $slug)->first();
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();

        record_page_view($request);

        return view('Blogpage::intprogram_pages', compact('blog', 'data'));
    }
}
