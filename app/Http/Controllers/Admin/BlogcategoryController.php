<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

/**
 * Admin: Blog Category CRUD (no uploads). Ported from the legacy
 * Admin\BlogcategoryController. Status/delete via AdminCrudActions.
 */
class BlogcategoryController extends Controller
{
    use AdminCrudActions;

    protected string $model = BlogCategory::class;

    protected string $table = 'tbl_blog_category';

    public function create(Request $request)
    {
        $data = BlogCategory::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::blog_category_create', compact('data'));
    }

    public function edit(Request $request, $url)
    {
        $data = BlogCategory::where('uniqueid', '=', $url)->get();

        return view('Admin::blog_category_create', compact('data'));
    }

    public function addupdate(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));
        $uniqueid = trim((string) $request->input('uniqueid'));

        try {
            if ($uniqueid !== '') {
                BlogCategory::where('uniqueid', '=', $uniqueid)->update([
                    'category_name' => $name,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Blog Category updated successfully.']);
            }

            BlogCategory::insert([
                'uniqueid' => random_unique_id(),
                'category_name' => $name,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Blog Category created successfully.']);
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

        $bannerifo = BlogCategory::where(function ($q) use ($searchdata) {
            $q->orWhere('category_name', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::blog_category_ajax', compact('bannerifo'));
        }

        return view('Admin::blog_category_listing', compact('bannerifo'));
    }
}
