<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\PlacementPartner;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Placement Partners CRUD. Ported verbatim from the legacy
 * Admin\PlacementpartnersController. Status/delete via AdminCrudActions.
 */
class PlacementpartnersController extends Controller
{
    use AdminCrudActions;

    protected string $model = PlacementPartner::class;

    protected string $table = 'tbl_placementpartners';

    public function __construct(private readonly ImageUploadService $images) {}

    public function createplacementpartners(Request $request)
    {
        $data = PlacementPartner::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::placement_partners_create', compact('data'));
    }

    public function editplacementpartners(Request $request, $url)
    {
        $data = PlacementPartner::where('uniqueid', '=', $url)->get();

        return view('Admin::placement_partners_create', compact('data'));
    }

    public function addupdateplacementpartners(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->images->resolve($request->file('imageidd'), $image_name, $imagePath, 'placementpartners');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                PlacementPartner::where('uniqueid', '=', $uniqueid)->update([
                    'name' => $name,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Placement Partners updated successfully.']);
            }

            PlacementPartner::insert([
                'uniqueid' => random_unique_id(),
                'name' => $name,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Placement Partners created successfully.']);
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

        $bannerifo = PlacementPartner::where(function ($q) use ($searchdata) {
            $q->orWhere('name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::placement_partners_ajax', compact('bannerifo'));
        }

        return view('Admin::placement_partners_listing', compact('bannerifo'));
    }
}
