<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Public: category pages. Ported from the legacy Categories\CategoriesController.
 *
 * NOTE: these actions query `tbl_course` (with `type`/`trending` columns), which
 * does NOT exist in the current database (only `courses` does). This module is
 * therefore non-functional locally and is ported verbatim pending the missing
 * production table — see REFACTOR_PLAN open items.
 */
class CategoriesController extends Controller
{
    public function getCategoryPage($category)
    {
        $type = strtoupper(str_replace('-', ' ', $category));

        $data['testimonial'] = DB::table('tbl_testimonial')->where('status', '=', '1')->get();
        $data['courses'] = DB::table('tbl_course')->orderBy('id', 'desc')->where('status', '=', 1)->where('type', '=', $type)->where('trending', '=', 1)->get();
        $data['NotCoursesTrending'] = DB::table('tbl_course')->orderBy('id', 'desc')->where('status', '=', 1)->where('type', '=', $type)->get();

        return view('Categories::index', compact('data', 'category'));
    }

    public function getCategoryPageCurrency($currency, $category)
    {
        $type = strtoupper(str_replace('-', ' ', $category));

        $data['testimonial'] = DB::table('tbl_testimonial')->where('status', '=', '1')->get();
        $data['courses'] = DB::table('tbl_course')->orderBy('id', 'desc')->where('status', '=', 1)->where('type', '=', $type)->where('trending', '=', 1)->get();
        $data['NotCoursesTrending'] = DB::table('tbl_course')->orderBy('id', 'desc')->where('status', '=', 1)->where('type', '=', $type)->get();

        if ($currency === 'my') {
            return view('Categories::MY.index', compact('data', 'category', 'currency'));
        }

        return view('Categories::IN.index', compact('data', 'category', 'currency'));
    }
}
