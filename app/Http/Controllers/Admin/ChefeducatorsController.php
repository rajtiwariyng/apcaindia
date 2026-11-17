<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\ChefEducator;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Chef Educators CRUD. Ported verbatim from the legacy
 * Admin\ChefeducatorsController. Status/delete via AdminCrudActions.
 */
class ChefeducatorsController extends Controller
{
    use AdminCrudActions;

    protected string $model = ChefEducator::class;

    protected string $table = 'tbl_chefeducators';

    public function __construct(private readonly ImageUploadService $images) {}

    public function createchefeducators(Request $request)
    {
        $data = ChefEducator::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::chef_educators_create', compact('data'));
    }

    public function editchefeducators(Request $request, $url)
    {
        $data = ChefEducator::where('uniqueid', '=', $url)->get();

        return view('Admin::chef_educators_create', compact('data'));
    }

    public function addupdatechefeducators(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $designation = trim((string) $request->input('designation'));
        $facebook = trim((string) $request->input('facebook'));
        $insta = trim((string) $request->input('insta'));
        $description = trim((string) $request->input('description'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            $filename = $this->images->resolve($request->file('imageidd'), $image_name, $imagePath, 'chefeducators');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                ChefEducator::where('uniqueid', '=', $uniqueid)->update([
                    'name' => $name,
                    'facebook' => $facebook,
                    'insta' => $insta,
                    'description' => $description,
                    'designation' => $designation,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Chef Educators updated successfully.']);
            }

            ChefEducator::insert([
                'uniqueid' => random_unique_id(),
                'name' => $name,
                'facebook' => $facebook,
                'insta' => $insta,
                'description' => $description,
                'designation' => $designation,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Chef Educators created successfully.']);
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

        $bannerifo = ChefEducator::where(function ($q) use ($searchdata) {
            $q->orWhere('name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::chef_educators_ajax', compact('bannerifo'));
        }

        return view('Admin::chef_educators_listing', compact('bannerifo'));
    }
}
