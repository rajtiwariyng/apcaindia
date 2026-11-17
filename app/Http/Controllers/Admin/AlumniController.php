<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Alumni CRUD. Ported verbatim from the legacy Admin\AlumniController.
 * Status/delete via AdminCrudActions.
 */
class AlumniController extends Controller
{
    use AdminCrudActions;

    protected string $model = Alumni::class;

    protected string $table = 'tbl_alumni';

    public function __construct(private readonly ImageUploadService $images) {}

    public function createalumni(Request $request)
    {
        $data = Alumni::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::alumni_create', compact('data'));
    }

    public function editalumni(Request $request, $url)
    {
        $data = Alumni::where('uniqueid', '=', $url)->get();

        return view('Admin::alumni_create', compact('data'));
    }

    public function addupdatealumni(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $designation = trim((string) $request->input('designation'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->images->resolve($request->file('imageidd'), $image_name, $imagePath, 'alumni');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                Alumni::where('uniqueid', '=', $uniqueid)->update([
                    'name' => $name,
                    'designation' => $designation,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'alumni updated successfully.']);
            }

            Alumni::insert([
                'uniqueid' => random_unique_id(),
                'name' => $name,
                'designation' => $designation,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'alumni created successfully.']);
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

        $bannerifo = Alumni::where(function ($q) use ($searchdata) {
            $q->orWhere('name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::alumni_ajax', compact('bannerifo'));
        }

        return view('Admin::alumni_listing', compact('bannerifo'));
    }
}
