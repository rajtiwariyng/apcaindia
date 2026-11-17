<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\SupportingBrand;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Supporting Brands CRUD. Ported verbatim from the legacy
 * Admin\SupportingbrandsController. Status/delete via AdminCrudActions.
 */
class SupportingbrandsController extends Controller
{
    use AdminCrudActions;

    protected string $model = SupportingBrand::class;

    protected string $table = 'tbl_supportingbrands';

    public function __construct(private readonly ImageUploadService $images) {}

    public function createsupportingbrands(Request $request)
    {
        $data = SupportingBrand::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::supporting_brands_create', compact('data'));
    }

    public function editsupportingbrands(Request $request, $url)
    {
        $data = SupportingBrand::where('uniqueid', '=', $url)->get();

        return view('Admin::supporting_brands_create', compact('data'));
    }

    public function addupdatesupportingbrands(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->images->resolve($request->file('imageidd'), $image_name, $imagePath, 'supportingbrands');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                SupportingBrand::where('uniqueid', '=', $uniqueid)->update([
                    'name' => $name,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Supporting Brand updated successfully.']);
            }

            SupportingBrand::insert([
                'uniqueid' => random_unique_id(),
                'name' => $name,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Supporting Brand Partners created successfully.']);
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

        $bannerifo = SupportingBrand::where(function ($q) use ($searchdata) {
            $q->orWhere('name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::supporting_brands_ajax', compact('bannerifo'));
        }

        return view('Admin::supporting_brands_listing', compact('bannerifo'));
    }
}
