<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\AdminCrudActions;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

/**
 * Admin: FAQs CRUD. Ported from the legacy Admin\FaqsController (no uploads).
 *
 * The legacy code had a variable swap plus a duplicate 'question' array key that
 * cancelled each other out, netting to question->question and answer->answer.
 * We store directly (same observable result). Status/delete via AdminCrudActions.
 */
class FaqsController extends Controller
{
    use AdminCrudActions;

    protected string $model = Faq::class;

    protected string $table = 'tbl_faqs';

    public function createfaqs(Request $request)
    {
        $data = Faq::where('uniqueid', '=', $request->segment(4))->get();

        return view('Admin::faqs_create', compact('data'));
    }

    public function editfaqs(Request $request, $url)
    {
        $data = Faq::where('uniqueid', '=', $url)->get();

        return view('Admin::faqs_create', compact('data'));
    }

    public function addupdatefaqs(Request $request)
    {
        $question = trim((string) $request->input('question'));
        $answer = trim((string) $request->input('answer'));
        $home = trim((string) $request->input('home'));
        $uniqueid = trim((string) $request->input('uniqueid'));
        $publishingStatus = trim((string) $request->input('publishingStatus'));

        try {
            if ($uniqueid !== '') {
                Faq::where('uniqueid', '=', $uniqueid)->update([
                    'home' => $home,
                    'question' => $question,
                    'answer' => $answer,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'ip' => $request->ip(),
                    'status' => $publishingStatus,
                ]);

                return response()->json(['status' => '200', 'msg' => 'faqs updated successfully.']);
            }

            Faq::insert([
                'uniqueid' => random_unique_id(),
                'home' => $home,
                'question' => $question,
                'answer' => $answer,
                'created_at' => date('Y-m-d h:i:s'),
                'ip' => $request->ip(),
                'status' => $publishingStatus,
            ]);

            return response()->json(['status' => '200', 'msg' => 'faqs created successfully.']);
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

        $bannerifo = Faq::where(function ($q) use ($searchdata) {
            $q->orWhere('question', 'like', '%'.$searchdata.'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(20);

        if ($request->ajax()) {
            return view('Admin::faqs_ajax', compact('bannerifo'));
        }

        return view('Admin::faqs_listing', compact('bannerifo'));
    }
}
