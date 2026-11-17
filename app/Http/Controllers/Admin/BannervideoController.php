<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\BannerVideo;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Banner Video CRUD. Ported verbatim from the legacy
 * Admin\BannervideoController (image + optional video upload).
 *
 * Note: this module uses uniqid() for new uniqueids and now() for timestamps
 * (matching the legacy code), unlike the date('Y-m-d h:i:s') modules.
 */
class BannervideoController extends Controller
{
    use AdminCrudActions;

    protected string $model = BannerVideo::class;

    protected string $table = 'banner_videos';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function createbannervideo(Request $request)
    {
        $data = BannerVideo::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::bannervideo_create', compact('data'));
    }

    public function editbannervideo(Request $request, $url)
    {
        $data = BannerVideo::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::bannervideo_create', compact('data'));
    }

    public function addupdatebannervideo(Request $request)
    {
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $videoPath = trim((string) $request->input('videoPath'));
        $imageidd = $request->file('imageidd');
        $videoidd = $request->file('videoidd');
        $uniqueid = trim((string) $request->input('uniqueid'));
        $page = trim((string) $request->input('page'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        // Image: keep existing on update, otherwise it is required + validated.
        if ($image_name === $imagePath && $uniqueid !== '') {
            $filename = $image_name;
        } else {
            if (! $imageidd) {
                return response()->json(['status' => '401', 'msg' => 'Image is required']);
            }
            try {
                $filename = $this->uploads->store($imageidd, 'bannervideo', ['jpg', 'jpeg', 'png'], 2048000, [
                    'ext' => 'Upload only jpeg, jpg, or png file',
                    'size' => 'Image size should be less than 2MB',
                    'move' => 'Unable to upload image, please try again',
                ]);
            } catch (ImageUploadException $e) {
                return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
            }
        }

        // Video: optional; defaults to the existing path.
        $video_filename = $videoPath;
        if ($videoidd) {
            try {
                $video_filename = $this->uploads->store($videoidd, 'bannervideo', ['mp4', 'mov', 'avi'], 314572800, [
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
                if ($page === 'home' && ! $videoidd && empty($videoPath)) {
                    return response()->json(['status' => '401', 'msg' => 'Video is required for the Home page']);
                }

                BannerVideo::where('uniqueid', '=', $uniqueid)->update([
                    'image' => $filename,
                    'video_path' => $video_filename,
                    'updated_at' => now(),
                    'status' => $publishingStatus,
                    'page' => $page,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Banner updated successfully.']);
            }

            if (! $imageidd) {
                return response()->json(['status' => '401', 'msg' => 'Image is required for new entry']);
            }

            if ($page === 'home' && ! $videoidd) {
                return response()->json(['status' => '401', 'msg' => 'Video is required for Home page']);
            }

            BannerVideo::insert([
                'uniqueid' => uniqid(),
                'image' => $filename,
                'video_path' => $video_filename,
                'created_at' => now(),
                'status' => $publishingStatus,
                'page' => $page,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Banner created successfully.']);
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

        $bannervideoinfo = BannerVideo::where(function ($q) use ($searchdata) {
            $q->orWhere('page', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::bannervideo_ajax', compact('bannervideoinfo'));
        }

        return view('Admin::bannervideo_listing', compact('bannervideoinfo'));
    }
}
