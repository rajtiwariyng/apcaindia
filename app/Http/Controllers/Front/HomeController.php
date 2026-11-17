<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Public: home page. Ported from the legacy Home\HomeController.
 */
class HomeController extends Controller
{
    public function home(Request $request)
    {
        $data['testimonial'] = DB::table('tbl_testimonial')->orderBy('id', 'desc')->where('status', '=', 1)->where('home', '=', 1)->get();
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();
        $data['blogs'] = DB::table('tbl_blog')->orderBy('id', 'desc')->where('status', '=', 1)->paginate(3);
        $data['faqs'] = DB::table('tbl_faqs')->orderBy('id', 'asc')->where('status', '=', 1)->where('home', '=', 1)->get();
        $data['bannervideos'] = DB::table('banner_videos')->orderBy('id', 'asc')->where('status', '=', 1)->where('page', 'home')->first();
        $data['programs'] = DB::table('tbl_homeprogram')->orderBy('order_by', 'asc')->where('status', '=', 1)->get();
        $data['section1slider'] = DB::table('tbl_homeslider')->orderBy('order_by', 'asc')->where('status', '=', 1)->where('category', '=', 'section 1')->get();
        $data['section2slider'] = DB::table('tbl_homeslider')->orderBy('order_by', 'asc')->where('status', '=', 1)->where('category', '=', 'section 2')->get();
        $data['student'] = DB::table('tbl_homeslider')->orderBy('order_by', 'asc')->where('status', '=', 1)->where('category', '=', 'student')->where('page', '=', 'home')->first();
        $data['slidercontent'] = DB::table('tbl_content')->orderBy('id', 'asc')->where('status', '=', 1)->first();

        record_page_view($request);

        return view('Home::home', compact('data'));
    }
}
