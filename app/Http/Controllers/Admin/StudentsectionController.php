<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Student Section CRUD. Ported from the legacy
 * Admin\StudentsectionController. Stored in tbl_homeslider with
 * category = 'student' (shares the table with Home Slider). Status/delete via
 * AdminCrudActions on tbl_homeslider.
 */
class StudentsectionController extends Controller
{
    use AdminCrudActions;

    protected string $model = HomeSlider::class;

    protected string $table = 'tbl_homeslider';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function create(Request $request)
    {
        $data = HomeSlider::where('uniqueid', '=', $request->segment(4))
            ->where('category', '=', 'student')
            ->get();

        return view('Admin::student_section_create', compact('data'));
    }

    public function edit(Request $request, $url)
    {
        $data = HomeSlider::where('uniqueid', '=', $request->segment(4))
            ->where('category', '=', 'student')
            ->get();

        return view('Admin::student_section_create', compact('data'));
    }

    public function addupdate(Request $request)
    {
        $category = trim((string) $request->input('category'));
        $order_by = trim((string) $request->input('order_by'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));
        $caption = trim((string) $request->input('caption'));
        $page = trim((string) $request->input('page'));

        try {
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'studentsection');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                HomeSlider::where('uniqueid', '=', $uniqueid)->update([
                    'order_by' => $order_by,
                    'page' => $page,
                    'category' => $category,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                    'caption' => $caption,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Student Section updated successfully.']);
            }

            HomeSlider::insert([
                'uniqueid' => random_unique_id(),
                'order_by' => $order_by,
                'page' => $page,
                'category' => $category,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
                'caption' => $caption,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Student Section created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again']);
        }
    }

    public function listing(Request $request)
    {
        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $searchdata = $request->session()->get('search');

        $homesliderinfo = HomeSlider::where(function ($q) use ($searchdata) {
            $q->orWhere('caption', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->where('category', '=', 'student')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::student_section_ajax', compact('homesliderinfo'));
        }

        return view('Admin::student_section_listing', compact('homesliderinfo'));
    }
}
