<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ImageUploadException;
use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Pdf;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/**
 * Admin: PDF CRUD + intake-calendar content. Ported verbatim from the legacy
 * Admin\PdfController. Uses uniqid()/now() (matching legacy).
 */
class PdfController extends Controller
{
    use AdminCrudActions;

    protected string $model = Pdf::class;

    protected string $table = 'tbl_pdf';

    public function __construct(private readonly ImageUploadService $uploads) {}

    public function create(Request $request)
    {
        $data = Pdf::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::pdf_create', compact('data'));
    }

    public function edit(Request $request, $url)
    {
        $data = Pdf::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::pdf_create', compact('data'));
    }

    public function addupdate(Request $request)
    {
        $pdf_name = trim((string) $request->input('pdf_name'));
        $pdfPath = trim((string) $request->input('pdfPath'));
        $pdfidd = $request->file('pdfidd');
        $uniqueid = trim((string) $request->input('uniqueid'));
        $page = trim((string) $request->input('page'));
        $title = trim((string) $request->input('title'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        if ($pdf_name === $pdfPath && $uniqueid !== '') {
            $filename = $pdf_name;
        } else {
            if (! $pdfidd) {
                return response()->json(['status' => '401', 'msg' => 'Image is required']);
            }
            try {
                $filename = $this->uploads->store($pdfidd, 'pdf', ['pdf'], 20480000, [
                    'ext' => 'Upload only pdf file',
                    'size' => 'Pdf size should be less than 20MB',
                    'move' => 'Unable to upload Pdf, please try again',
                ]);
            } catch (ImageUploadException $e) {
                return response()->json(['status' => '401', 'msg' => $e->getMessage()]);
            }
        }

        try {
            if ($uniqueid !== '') {
                Pdf::where('uniqueid', '=', $uniqueid)->update([
                    'title' => $title,
                    'pdf_path' => $filename,
                    'updated_at' => now(),
                    'status' => $publishingStatus,
                    'page' => $page,
                ]);

                return response()->json(['status' => '200', 'msg' => 'Pdf updated successfully.']);
            }

            if (! $pdfidd) {
                return response()->json(['status' => '401', 'msg' => 'pdf is required for new entry']);
            }

            Pdf::insert([
                'uniqueid' => uniqid(),
                'title' => $title,
                'pdf_path' => $filename,
                'created_at' => now(),
                'status' => $publishingStatus,
                'page' => $page,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Pdf created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong, please try again']);
        }
    }

    public function intakecalender(Request $request, $url = null)
    {
        $data = Pdf::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::intakecalendar_create', compact('data'));
    }

    public function intakecalenderaddupdate(Request $request)
    {
        $content = trim((string) $request->input('content'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $page = trim((string) $request->input('page'));
        $title = trim((string) $request->input('title'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            if ($uniqueid !== '') {
                Pdf::where('uniqueid', '=', $uniqueid)->update([
                    'title' => $title,
                    'content' => $content,
                    'updated_at' => now(),
                    'status' => $publishingStatus,
                    'page' => $page,
                ]);

                return response()->json(['status' => '200', 'msg' => 'content updated successfully.']);
            }

            Pdf::insert([
                'uniqueid' => uniqid(),
                'title' => $title,
                'content' => $content,
                'created_at' => now(),
                'status' => $publishingStatus,
                'page' => $page,
            ]);

            return response()->json(['status' => '200', 'msg' => 'content created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => '401', 'msg' => 'Something went wrong, please try again']);
        }
    }

    public function listing(Request $request)
    {
        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $searchdata = $request->session()->get('search');

        $pdfinfo = Pdf::where(function ($q) use ($searchdata) {
            $q->orWhere('page', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::pdf_ajax', compact('pdfinfo'));
        }

        return view('Admin::pdf_listing', compact('pdfinfo'));
    }
}
