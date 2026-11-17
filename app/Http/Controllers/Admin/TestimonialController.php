<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Testimonial CRUD. Behavior ported verbatim from the legacy
 * Admin\TestimonialController. Status/delete come from AdminCrudActions.
 */
class TestimonialController extends Controller
{
    use AdminCrudActions;

    protected string $model = Testimonial::class;

    protected string $table = 'tbl_testimonial';

    public function __construct(private readonly ImageUploadService $images) {}

    public function createtestimonial(Request $request)
    {
        $data = Testimonial::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::testimonialcreate', compact('data'));
    }

    public function edittestimonial(Request $request, $url)
    {
        $data = Testimonial::where('uniqueid', '=', $url)->get();

        return view('Admin::testimonialcreate', compact('data'));
    }

    public function addupdatetestimonial(Request $request)
    {
        $blogdescription = trim((string) $request->input('blogdescription'));
        $name = trim((string) $request->input('name'));
        $program = trim((string) $request->input('program'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));
        $home = trim((string) $request->input('home'));

        try {
            $filename = $this->images->resolve($request->file('imageidd'), $image_name, $imagePath, 'testimonial');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                Testimonial::where('uniqueid', '=', $uniqueid)->update([
                    'name' => $name,
                    'program' => $program,
                    'description' => $blogdescription,
                    'image' => $filename,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                    'home' => $home,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Testimonial updated successfully.']);
            }

            Testimonial::insert([
                'uniqueid' => random_unique_id(),
                'name' => $name,
                'program' => $program,
                'description' => $blogdescription,
                'image' => $filename,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
                'home' => $home,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Testimonial created successfully.']);
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

        $bannerifo = Testimonial::where(function ($q) use ($searchdata) {
            $q->orWhere('description', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::testimonialajax', compact('bannerifo'));
        }

        return view('Admin::testimonallisting', compact('bannerifo'));
    }
}
