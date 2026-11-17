<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Course page CRUD. Ported from the legacy Admin\CoursepageController.
 *
 * The legacy SEO sync block was commented out (dead) and is therefore omitted.
 * Slug suffixes preserved: '-mag' on update (when >1 same-title rows), '-apca'
 * on insert (when >=1). Status/delete via AdminCrudActions on `courses`.
 */
class CoursepageController extends Controller
{
    use AdminCrudActions;

    protected string $model = Course::class;

    protected string $table = 'courses';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function createcoursepage(Request $request)
    {
        $data = Course::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::coursepage_create', compact('data'));
    }

    public function updatecoursepage(Request $request, $url)
    {
        $data = Course::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::coursepage_create', compact('data'));
    }

    public function addupdatecoursepage(Request $request)
    {
        $title = trim((string) $request->input('title'));
        $slug = trim((string) $request->input('slug'));
        $duration = trim((string) $request->input('duration'));
        $schedule = trim((string) $request->input('schedule'));
        $certification = trim((string) $request->input('certification'));
        $internship = trim((string) $request->input('internship'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $overview = trim((string) $request->input('overview'));
        $structure = trim((string) $request->input('structure'));
        $bonus = trim((string) $request->input('bonus'));
        $international_internship = trim((string) $request->input('international_internship'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        $checkBlog = Course::where('title', '=', $title)->get();

        try {
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'coursepage');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                if ($checkBlog->count() > 1) {
                    $slug = $slug.'-mag';
                }

                Course::where('uniqueid', '=', $uniqueid)->update([
                    'title' => $title,
                    'duration' => $duration,
                    'image' => $filename,
                    'schedule' => $schedule,
                    'certification' => $certification,
                    'slug' => strtolower($slug),
                    'internship' => $internship,
                    'overview' => $overview,
                    'structure' => $structure,
                    'bonus' => $bonus,
                    'international_internship' => $international_internship,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Course updated successfully.']);
            }

            if ($checkBlog->count() > 0) {
                $slug = $slug.'-apca';
            }

            Course::insert([
                'uniqueid' => random_unique_id(),
                'title' => $title,
                'duration' => $duration,
                'image' => $filename,
                'schedule' => $schedule,
                'certification' => $certification,
                'slug' => strtolower($slug),
                'internship' => $internship,
                'overview' => $overview,
                'structure' => $structure,
                'bonus' => $bonus,
                'international_internship' => $international_internship,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Course created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again']);
        }
    }

    public function listingcoursepage(Request $request)
    {
        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $searchdata = $request->session()->get('search');

        $bannerifo = Course::from('courses as c')
            ->leftJoin('tbl_pdf as p', 'p.slug', '=', 'c.slug')
            ->where(function ($q) use ($searchdata) {
                $q->where('c.title', 'like', '%'.$searchdata.'%')
                    ->orWhere('c.certification', 'like', '%'.$searchdata.'%');
            })
            ->select('c.*', 'p.download_count')
            ->orderBy('c.id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::coursepage_ajax', compact('bannerifo'));
        }

        return view('Admin::coursepage_listing', compact('bannerifo'));
    }
}
