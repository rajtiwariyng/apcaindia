<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Photo Gallery CRUD. Ported verbatim from the legacy
 * Admin\GalleryController. Status/delete via AdminCrudActions.
 *
 * Note: the legacy `title` field is intentionally not written (it was commented
 * out in the original); only category, image and caption are persisted.
 * Upload directory is `photogallery` (matching the legacy path).
 */
class GalleryController extends Controller
{
    use AdminCrudActions;

    protected string $model = Gallery::class;

    protected string $table = 'tbl_gallery';

    public function __construct(private readonly ImageUploadService $images) {}

    public function creategallery(Request $request)
    {
        $data = Gallery::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::creategallery', compact('data'));
    }

    public function editgallery(Request $request, $url)
    {
        $data = Gallery::where('uniqueid', '=', $url)->get();

        return view('Admin::creategallery', compact('data'));
    }

    public function addupdategallery(Request $request)
    {
        $category = trim((string) $request->input('category'));
        $caption = trim((string) $request->input('caption'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->images->resolve($request->file('imageidd'), $image_name, $imagePath, 'photogallery');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                Gallery::where('uniqueid', '=', $uniqueid)->update([
                    'category' => $category,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                    'caption' => $caption,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Event gallery updated successfully.']);
            }

            Gallery::insert([
                'uniqueid' => random_unique_id(),
                'category' => $category,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
                'caption' => $caption,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Event gallery created successfully.']);
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

        // NOTE: the gallery views expect the variable name `galleryinfo`
        // (unlike other modules which use `bannerifo`).
        $galleryinfo = Gallery::where(function ($q) use ($searchdata) {
            $q->orWhere('caption', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::ajaxgallery', compact('galleryinfo'));
        }

        return view('Admin::gallerylisting', compact('galleryinfo'));
    }
}
