<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\CourseModule;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Course module CRUD (child of a course via course_id). Ported from the
 * legacy Admin\CoursemoduleController. Status/delete via AdminCrudActions on
 * `course_modules`.
 */
class CoursemoduleController extends Controller
{
    use AdminCrudActions;

    protected string $model = CourseModule::class;

    protected string $table = 'course_modules';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function createcoursemodule(Request $request, $courseid = null)
    {
        $course_id = $request->segment(4);
        $data = CourseModule::where('uniqueid', '=', $request->segment(5))->get();

        return view('Admin::coursemodule_create', compact('data', 'course_id'));
    }

    public function updatecoursemodule(Request $request, $courseid = null, $url = null)
    {
        $course_id = $request->segment(4);
        $data = CourseModule::where('uniqueid', '=', $request->segment(5))->get();

        return view('Admin::coursemodule_create', compact('data', 'course_id'));
    }

    public function addupdatecoursemodule(Request $request)
    {
        $title = trim((string) $request->input('title'));
        $course_id = trim((string) $request->input('course_id'));
        $content = trim((string) $request->input('content'));
        $order = trim((string) $request->input('order'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'coursemodule');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                CourseModule::where('uniqueid', '=', $uniqueid)->update([
                    'title' => $title,
                    'course_id' => $course_id,
                    'image' => $filename,
                    'content' => $content,
                    'order' => $order,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json([
                    'status' => '200',
                    'course_id' => $course_id,
                    'msg' => 'Course module updated successfully.',
                ]);
            }

            CourseModule::insert([
                'uniqueid' => random_unique_id(),
                'title' => $title,
                'course_id' => $course_id,
                'image' => $filename,
                'content' => $content,
                'order' => $order,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json([
                'status' => '200',
                'course_id' => $course_id,
                'msg' => 'Course module created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again']);
        }
    }

    public function listingcoursemodule(Request $request, $courseid = null)
    {
        $course_id = $request->segment(4);

        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $searchdata = $request->session()->get('search');

        $bannerifo = CourseModule::where(function ($q) use ($searchdata) {
            $q->orWhere('title', 'like', '%'.$searchdata.'%')
                ->orWhere('course_id', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->where('status', '=', 1)
            ->where('course_id', '=', $course_id)
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::coursemodule_ajax', compact('bannerifo', 'course_id'));
        }

        return view('Admin::coursemodule_listing', compact('bannerifo', 'course_id'));
    }
}
