<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\HomeSlider;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Home Slider CRUD + home content sub-form. Ported from the legacy
 * Admin\HomesliderController. Slider rows live in tbl_homeslider (category !=
 * 'student'); the content sub-form lives in tbl_content. Status/delete via
 * AdminCrudActions on tbl_homeslider.
 */
class HomesliderController extends Controller
{
    use AdminCrudActions;

    protected string $model = HomeSlider::class;

    protected string $table = 'tbl_homeslider';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function create(Request $request)
    {
        $data = HomeSlider::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::home_slider_create', compact('data'));
    }

    public function edit(Request $request, $url)
    {
        $data = HomeSlider::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::home_slider_create', compact('data'));
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

        try {
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'homeslider');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                HomeSlider::where('uniqueid', '=', $uniqueid)->update([
                    'order_by' => $order_by,
                    'category' => $category,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                    'caption' => $caption,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Home Slider updated successfully.']);
            }

            HomeSlider::insert([
                'uniqueid' => random_unique_id(),
                'order_by' => $order_by,
                'category' => $category,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
                'caption' => $caption,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Home Slider created successfully.']);
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
            ->where('category', '!=', 'student')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::home_slider_ajax', compact('homesliderinfo'));
        }

        return view('Admin::home_slider_listing', compact('homesliderinfo'));
    }

    public function updatestudent(Request $request, $url)
    {
        $data = HomeSlider::where('uniqueid', '=', $request->segment(4))
            ->where('category', '=', 'student')
            ->get();

        return view('Admin::home_student_create', compact('data'));
    }

    public function updatecontent(Request $request, $url)
    {
        $data = Content::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::home_slider_content_create', compact('data'));
    }

    public function contentaddupdate(Request $request)
    {
        $title = trim((string) $request->input('title'));
        $title2 = trim((string) $request->input('title2'));
        $content = trim((string) $request->input('content'));
        $content2 = trim((string) $request->input('content2'));
        $uniqueid = trim((string) $request->input('uniqueid'));

        try {
            if ($uniqueid !== '') {
                Content::where('uniqueid', '=', $uniqueid)->update([
                    'title' => $title,
                    'title2' => $title2,
                    'content' => $content,
                    'content2' => $content2,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                ]);

                return response()->json(['status' => '200', 'msg' => 'Home Content updated successfully.']);
            }

            Content::insert([
                'uniqueid' => random_unique_id(),
                'title' => $title,
                'title2' => $title2,
                'content' => $content,
                'content2' => $content2,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
            ]);

            return response()->json(['status' => '200', 'msg' => 'Home Content created successfully.']);
        } catch (\Exception $e) {
            // Legacy had a stray dd($e) here; dropped so the error path returns JSON cleanly.
            return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again']);
        }
    }
}
