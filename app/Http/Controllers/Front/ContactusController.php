<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Public: contact-us page + enquiry form. Ported from the legacy
 * Contactus\ContactusController.
 */
class ContactusController extends Controller
{
    public function contactus(Request $request)
    {
        $page = $request->segment(count($request->segments()));

        $data['banner'] = DB::table('banner_videos')->where('page', $page)->where('status', 1)->orderBy('id', 'asc')->first();
        $data['placementpartners'] = DB::table('tbl_placementpartners')->orderBy('id', 'desc')->where('status', '=', 1)->get();

        record_page_view($request);

        return view('Contactus::contactus', compact('data'));
    }

    public function submitForm(Request $request)
    {
        if ($request->page_name === 'Enquire Now') {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'date_time' => 'nullable|date_format:Y-m-d h:i A',
                'questions' => 'required|string',
                'mobile' => 'required|digits_between:10,15',
                'program' => 'required|string',
                'privacy' => 'required',
            ]);

            $formattedDateTime = $request->date_time
                ? Carbon::createFromFormat('Y-m-d h:i A', $request->date_time)->format('Y-m-d H:i:s')
                : null;
        } else {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'date_time' => 'required|date_format:Y-m-d h:i A',
                'mobile' => 'required|digits_between:10,15',
                'program' => 'required|string',
                'privacy' => 'required',
            ]);

            $formattedDateTime = Carbon::createFromFormat('Y-m-d h:i A', $request->date_time)->format('Y-m-d H:i:s');
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Contactus::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'date_time' => $formattedDateTime,
            'mobile' => $request->mobile,
            'program' => $request->program,
            'questions' => $request->questions,
            'page_name' => $request->page_name,
            'privacy' => $request->has('privacy') ? 1 : 0,
        ]);

        return response()->json(['success' => 'Thank you. We’ve received your message and will reach out to you soon.'], 200);
    }
}
