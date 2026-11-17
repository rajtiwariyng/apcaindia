<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Intcontent;
use App\Models\Intprogram;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: International Program CRUD + int-content sub-form. Ported from the
 * legacy Admin\IntprogramController.
 *
 * BUG FIX (flagged): the legacy status() toggled a non-existent table named
 * "IntprogramController" (the class name) — so it never worked. The trait's
 * changeStatus() correctly updates tbl_intprogram by uniqueid.
 */
class IntprogramController extends Controller
{
    use AdminCrudActions;

    protected string $model = Intprogram::class;

    protected string $table = 'tbl_intprogram';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function create(Request $request)
    {
        $data = Intprogram::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::intprogram_create', compact('data'));
    }

    public function edit(Request $request, $url)
    {
        $data = Intprogram::where('uniqueid', '=', $url)->get();

        return view('Admin::intprogram_create', compact('data'));
    }

    public function intcontent(Request $request, $url = null)
    {
        $data = Intcontent::where('uniqueid', '=', $url)->get();

        return view('Admin::intcontent_create', compact('data'));
    }

    public function intcontentaddupdate(Request $request)
    {
        $content = trim((string) $request->input('content'));
        $program_title = trim((string) $request->input('program_title'));
        $students_title = trim((string) $request->input('students_title'));
        $description = trim((string) $request->input('description'));
        $url = trim((string) $request->input('url'));
        $uniqueid = trim((string) $request->input('uniqueid'));

        try {
            if ($uniqueid !== '') {
                Intcontent::where('uniqueid', '=', $uniqueid)->update([
                    'content' => $content,
                    'program_title' => $program_title,
                    'students_title' => $students_title,
                    'description' => $description,
                    'url' => $url,
                    'updated_at' => date('Y-m-d h:i:s'),
                ]);

                return response()->json(['status' => '200', 'msg' => 'Content updated successfully.']);
            }

            Intcontent::insert([
                'uniqueid' => random_unique_id(),
                'content' => $content,
                'program_title' => $program_title,
                'students_title' => $students_title,
                'description' => $description,
                'url' => $url,
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return response()->json(['status' => '200', 'msg' => 'Content created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again']);
        }
    }

    public function addupdate(Request $request)
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
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'intprogram');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                Intprogram::where('uniqueid', '=', $uniqueid)->update([
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

            Intprogram::insert([
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

        $bannerifo = Intprogram::where(function ($q) use ($searchdata) {
            $q->orWhere('name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::intprogram_ajax', compact('bannerifo'));
        }

        return view('Admin::intprogram_listing', compact('bannerifo'));
    }
}
