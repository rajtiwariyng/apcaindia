<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Public: courses listing + course details + PDF download tracking. Ported from
 * the legacy Courses\CoursesController.
 *
 * NOTE: the legacy `courses()` action was commented out (so /courses 500'd).
 * It is reinstated here from the legacy intent (renders Courses::courses with
 * testimonial/placement/chef data).
 */
class CoursesController extends Controller
{
    public function courses()
    {
        $data['testimonial'] = DB::table('tbl_testimonial')->orderBy('id', 'desc')->where('status', '=', 1)->where('home', '=', 1)->get();
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();
        $data['chefeducators'] = DB::table('tbl_chefeducators')->orderBy('id', 'asc')->where('status', '=', 1)->get();

        return view('Courses::courses', compact('data'));
    }

    public function courseDetails(Request $request, $slug)
    {
        $data['banner'] = DB::table('banner_videos')->where('page', $slug)->where('status', 1)->orderBy('id', 'asc')->first();
        $course = DB::table('courses')->where('slug', '=', $slug)->first();
        $data['testimonial'] = DB::table('tbl_testimonial')->orderBy('id', 'desc')->where('status', '=', 1)->where('home', '=', 1)->get();
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();
        $data['chefeducators'] = DB::table('tbl_chefeducators')->orderBy('id', 'asc')->where('status', '=', 1)->get();
        $coursemodule = DB::table('course_modules')->where('status', '=', 1)->where('course_id', '=', $course->uniqueid)->orderBy('order', 'asc')->get();
        $data['student'] = DB::table('tbl_homeslider')->orderBy('order_by', 'asc')->where('status', '=', 1)->where('category', '=', 'student')->where('page', '=', $slug)->first();
        $pdf_path = DB::table('tbl_pdf')->where('status', 1)->where('slug', $course->slug)->orderBy('id', 'asc')->value('id');

        record_page_view($request);

        return view('Courses::course-details', compact('data', 'course', 'coursemodule', 'pdf_path'));
    }

    public function download($id)
    {
        $pdf = DB::table('tbl_pdf')->where('id', $id)->first();

        if (! $pdf) {
            abort(404);
        }

        DB::table('tbl_pdf')->where('id', $id)->increment('download_count');

        $path = public_path('assets/upload/pdf/'.$pdf->pdf_path);

        if (! file_exists($path)) {
            abort(404, 'PDF file not found.');
        }

        return response()->download($path, $pdf->pdf_path, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
