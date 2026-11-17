<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Pages CRUD (image + optional video + content). Ported verbatim from
 * the legacy Admin\PagesController. Uses uniqid()/now() (matching legacy).
 */
class PagesController extends Controller
{
    use AdminCrudActions;

    protected string $model = Page::class;

    protected string $table = 'tbl_pages';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function create(Request $request)
    {
        $data = Page::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::pages_create', compact('data'));
    }

    public function edit(Request $request, $url)
    {
        $data = Page::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::pages_create', compact('data'));
    }

    public function addupdate(Request $request)
    {
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $videoPath = trim((string) $request->input('videoPath'));
        $imageidd = $request->file('imageidd');
        $videoidd = $request->file('videoidd');
        $uniqueid = trim((string) $request->input('uniqueid'));
        $pages = trim((string) $request->input('pages'));
        $title = trim((string) $request->input('title'));
        $content = trim((string) $request->input('content'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        // Image: defaults to existing path; replaced if a new file is uploaded.
        $filename = $imagePath;
        if ($imageidd) {
            try {
                $filename = $this->uploads->store($imageidd, 'pages', ['jpg', 'jpeg', 'png'], 2048000, [
                    'ext' => 'Upload only jpeg, jpg, or png file',
                    'size' => 'Image size should be less than 2MB',
                    'move' => 'Unable to upload image, please try again',
                ]);
            } catch (ImageUploadException $e) {
                return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
            }
        }

        // Video: optional; defaults to existing path.
        $video_filename = $videoPath;
        if ($videoidd) {
            try {
                $video_filename = $this->uploads->store($videoidd, 'pages', ['mp4', 'mov', 'avi'], 314572800, [
                    'ext' => 'Upload only mp4, mov, or avi file for video',
                    'size' => 'Video size should be less than 300MB',
                    'move' => 'Unable to upload video, please try again',
                ]);
            } catch (ImageUploadException $e) {
                return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
            }
        }

        try {
            if ($uniqueid !== '') {
                if ($pages === 'home' && ! $videoidd && empty($videoPath)) {
                    return response()->json(['status' => '401', 'msg' => 'Video is required for the Home page']);
                }

                Page::where('uniqueid', $uniqueid)->update([
                    'image' => $filename,
                    'content' => $content,
                    'title' => $title,
                    'pages' => $pages,
                    'video_path' => $video_filename,
                    'updated_at' => now(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Page updated successfully.']);
            }

            if ($pages === 'home' && ! $videoidd) {
                return response()->json(['status' => '401', 'msg' => 'Video is required for Home page']);
            }

            Page::insert([
                'uniqueid' => uniqid(),
                'image' => $filename,
                'content' => $content,
                'title' => $title,
                'pages' => $pages,
                'video_path' => $video_filename,
                'created_at' => now(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Page created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong, please try again']);
        }
    }

    public function listing(Request $request)
    {
        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $searchdata = $request->session()->get('search');

        $pagesinfo = Page::where(function ($q) use ($searchdata) {
            $q->orWhere('title', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::pages_ajax', compact('pagesinfo'));
        }

        return view('Admin::pages_listing', compact('pagesinfo'));
    }
}
