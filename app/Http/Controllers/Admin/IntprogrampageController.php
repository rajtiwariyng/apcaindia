<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\IntprogramPage;
use App\Models\Seo;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: International Program Page CRUD (blog-like, with SEO sync). Ported from
 * the legacy Admin\IntprogrampageController. Slug suffix '-intprogram' preserved.
 * Status/delete via AdminCrudActions on `tbl_intprogram_page`.
 */
class IntprogrampageController extends Controller
{
    use AdminCrudActions;

    protected string $model = IntprogramPage::class;

    protected string $table = 'tbl_intprogram_page';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function create(Request $request)
    {
        $data = IntprogramPage::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::intprogram_page_create', compact('data'));
    }

    public function update(Request $request, $url)
    {
        $data = IntprogramPage::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::intprogram_page_create', compact('data'));
    }

    public function addupdate(Request $request)
    {
        $catgoryName = trim((string) $request->input('catgoryName'));
        $blogtitle = trim((string) $request->input('blogtitle'));
        $img_alt = trim((string) $request->input('img_alt'));
        $slug = trim((string) $request->input('blogslug'));
        $blogdescription = trim((string) $request->input('blogdescription'));
        $blogShortdescription = trim((string) $request->input('blogShortdescription'));
        $image_name = trim((string) $request->input('image_name'));
        $imagePath = trim((string) $request->input('imagePath'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $metatitle = trim((string) $request->input('metatitle'));
        $metakeywords = trim((string) $request->input('metakeywords'));
        $metadesc = trim((string) $request->input('metadesc'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        $checkBlog = IntprogramPage::where('title', '=', $blogtitle)->get();

        // SEO sync for this page slug.
        $slug22 = trim('intprogram-page'.'/'.$slug);

        if (Seo::where('url_slug', '=', $slug22)->exists()) {
            Seo::where('url_slug', '=', $slug22)->update([
                'seo_title' => $metatitle,
                'seo_desc' => $metadesc,
                'seo_keywords' => $metakeywords,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        } else {
            Seo::insert([
                'url_slug' => strtolower('intprogram-page'.'/'.$slug),
                'page_name' => 'intprogram-page',
                'seo_title' => $metatitle,
                'seo_desc' => $metadesc,
                'seo_keywords' => $metakeywords,
                'created_at' => date('Y-m-d h:i:s'),
            ]);
        }

        try {
            $filename = $this->uploads->resolve($request->file('imageidd'), $image_name, $imagePath, 'intprogram_page');
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        try {
            if ($uniqueid !== '') {
                if ($checkBlog->count() > 1) {
                    $slug = $slug.'-intprogram';
                }

                IntprogramPage::where('uniqueid', '=', $uniqueid)->update([
                    'title' => $blogtitle,
                    'description' => $blogdescription,
                    'image' => $filename,
                    'img_alt' => $img_alt,
                    'category' => $catgoryName,
                    'slug' => strtolower($slug),
                    'blog_short_desc' => $blogShortdescription,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'metatitle' => $metatitle,
                    'metakeywords' => $metakeywords,
                    'metadesc' => $metadesc,
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Program Page updated successfully.']);
            }

            if ($checkBlog->count() > 0) {
                $slug = $slug.'-intprogram';
            }

            IntprogramPage::insert([
                'uniqueid' => random_unique_id(),
                'title' => $blogtitle,
                'description' => $blogdescription,
                'image' => $filename,
                'img_alt' => $img_alt,
                'category' => $catgoryName,
                'slug' => strtolower($slug),
                'blog_short_desc' => $blogShortdescription,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'metatitle' => $metatitle,
                'metakeywords' => $metakeywords,
                'metadesc' => $metadesc,
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Program Page created successfully.']);
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

        $bannerifo = IntprogramPage::where(function ($q) use ($searchdata) {
            $q->orWhere('title', 'like', '%'.$searchdata.'%')
                ->orWhere('description', 'like', '%'.$searchdata.'%')
                ->orWhere('category', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->where('status', '=', 1)
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::intprogram_page_ajax', compact('bannerifo'));
        }

        return view('Admin::intprogram_page_listing', compact('bannerifo'));
    }
}
