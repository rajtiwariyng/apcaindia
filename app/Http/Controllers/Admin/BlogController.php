<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Seo;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: Blog CRUD.
 *
 * Behavior ported verbatim from the legacy Admin\BlogController. Authorization
 * is now enforced once by the `auth.admin` route-group middleware instead of a
 * per-method session check.
 *
 * Preserved legacy quirks (intentional, to keep behavior identical):
 *  - On save, a matching `tbl_seo` row (url_slug = "blog/{slug}") is updated or
 *    inserted.
 *  - Slug suffixes: when a blog with the same title already exists, the slug is
 *    suffixed with "-mag" (on update, when >1 match) or "-chanderpur" (on
 *    insert, when >=1 match).
 *  - created_at/updated_at are written with date("Y-m-d h:i:s") (12-hour clock,
 *    matching the legacy format).
 *  - JSON response shapes ('status' => '200'|'401', 'msg' => ...) are unchanged.
 */
class BlogController extends Controller
{
    public function __construct(private readonly ImageUploadService $images) {}

    public function createnewblog(Request $request)
    {
        $data = Blog::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::blogcreate', compact('data'));
    }

    public function updateblog(Request $request, $url)
    {
        $data = Blog::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::blogcreate', compact('data'));
    }

    public function addbloginfo(StoreBlogRequest $request)
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

        // Normalise slug: spaces -> hyphens, strip non-alphanumeric/hyphen chars.
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        $checkBlog = Blog::where('title', '=', $blogtitle)->get();

        // --- Sync the SEO row for this blog slug -----------------------------
        $slug22 = trim('blog'.'/'.$slug);

        if (Seo::where('url_slug', '=', $slug22)->exists()) {
            Seo::where('url_slug', '=', $slug22)->update([
                'seo_title' => $metatitle,
                'seo_desc' => $metadesc,
                'seo_keywords' => $metakeywords,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        } else {
            Seo::insert([
                'url_slug' => strtolower('blog'.'/'.$slug),
                'page_name' => 'blog',
                'seo_title' => $metatitle,
                'seo_desc' => $metadesc,
                'seo_keywords' => $metakeywords,
                'created_at' => date('Y-m-d h:i:s'),
            ]);
        }

        // --- Resolve the image (keep existing, or validate+store new) --------
        try {
            $filename = $this->images->resolve(
                $request->file('imageidd'),
                $image_name,
                $imagePath,
                'blog'
            );
        } catch (ImageUploadException $e) {
            return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
        }

        // --- Persist the blog ------------------------------------------------
        try {
            if ($uniqueid !== '') {
                if ($checkBlog->count() > 1) {
                    $slug = $slug.'-mag';
                }

                Blog::where('uniqueid', '=', $uniqueid)->update([
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

                return response()->json([
                    'status' => '200',
                    'msg' => 'Blog information updated successfully.2',
                ]);
            }

            if ($checkBlog->count() > 0) {
                $slug = $slug.'-chanderpur';
            }

            Blog::insert([
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

            return response()->json([
                'status' => '200',
                'msg' => 'Blog created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '401',
                'msg' => 'Something went wrong,please try again',
            ]);
        }
    }

    public function bloglisting(Request $request)
    {
        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $searchdata = $request->session()->get('search');

        $bannerifo = Blog::where(function ($q) use ($searchdata) {
            $q->orWhere('title', 'like', '%'.$searchdata.'%')
                ->orWhere('description', 'like', '%'.$searchdata.'%')
                ->orWhere('category', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::blogajax', compact('bannerifo'));
        }

        return view('Admin::bloglisting', compact('bannerifo'));
    }

    public function change_status(Request $request)
    {
        $id = trim((string) $request->input('id'));
        $status = trim((string) $request->input('status'));

        if ($id !== '') {
            Blog::where('uniqueid', '=', $id)->update(['status' => $status]);
        }
    }

    public function deleteblogdata(Request $request)
    {
        $useridd = trim((string) $request->input('useridd'));
        $table = trim((string) $request->input('table'));
        $colmn = trim((string) $request->input('colmn'));

        $deleted = 0;
        if ($table === 'tbl_blog') {
            $deleted = Blog::where($colmn, '=', $useridd)->delete();
        }

        if ($deleted) {
            return response()->json(['status' => '200', 'msg' => 'Data successfully deleted.']);
        }

        return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again!']);
    }
}
