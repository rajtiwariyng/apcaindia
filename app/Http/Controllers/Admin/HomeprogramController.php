<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\HomeProgram;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Home Programs CRUD. Ported from the legacy Admin\HomeprogramController.
 * Image rules identical to the shared resolve(); status/delete via AdminCrudActions.
 */
class HomeprogramController extends Controller
{
    use AdminCrudActions;

    protected string $model = HomeProgram::class;

    protected string $table = 'tbl_homeprogram';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function createhomeprogram(Request $request)
    {
        $data = HomeProgram::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::homeprogram_create', compact('data'));
    }

    public function edithomeprogram(Request $request, $url)
    {
        $data = HomeProgram::where('uniqueid', '=', $url)->get();

        return view('Admin::homeprogram_create', compact('data'));
    }

    public function addupdatehomeprogram(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $slug = trim((string) $request->input('slug'));
        $duration = trim((string) $request->input('duration'));
        $order_by = trim((string) $request->input('order_by'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'homeprogram');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                HomeProgram::where('uniqueid', '=', $uniqueid)->update([
                    'name' => $name,
                    'slug' => $slug,
                    'duration' => $duration,
                    'order_by' => $order_by,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Program updated successfully.']);
            }

            HomeProgram::insert([
                'uniqueid' => random_unique_id(),
                'name' => $name,
                'slug' => $slug,
                'duration' => $duration,
                'order_by' => $order_by,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Program created successfully.']);
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

        $bannerifo = HomeProgram::where(function ($q) use ($searchdata) {
            $q->orWhere('name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::homeprogram_ajax', compact('bannerifo'));
        }

        return view('Admin::homeprogram_listing', compact('bannerifo'));
    }
}
