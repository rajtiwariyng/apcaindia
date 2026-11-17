<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Illuminate\Http\Request;

/**
 * Admin: contact-us enquiry list + export view. Ported from the only two routed
 * leftover AdminController methods (contactus + contactdownload).
 */
class ContactEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $cmsurl = $request->segment(5);

        $request->session()->put('search', $request->has('search')
            ? $request->get('search')
            : ($request->session()->has('search') ? $request->session()->get('search') : ''));

        $search = $request->session()->get('search');

        $bannerifo = Contactus::orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('mobile', 'like', '%'.$search.'%')
            ->where('full_name', 'like', '%'.$cmsurl.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('Admin::ajaxcontact', compact('bannerifo'));
        }

        return view('Admin::contactus', compact('bannerifo'));
    }

    public function download()
    {
        $bannerifo = Contactus::orderBy('id', 'desc')->get();

        return view('Admin::downloadcontact', compact('bannerifo'));
    }
}
