<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Public: footer partial endpoints + newsletter subscribe. Ported from the
 * legacy Footer\FooterController.
 */
class FooterController extends Controller
{
    public function welcome()
    {
        return view('Footer::welcome');
    }

    public function errorpage()
    {
        return view('Footer::404');
    }

    public function privacy()
    {
        return view('Footer::privacy');
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:5|max:100',
        ]);

        if ($validator->fails()) {
            return 'All fields are required';
        }

        $email = $request->email;

        if (DB::table('subscribed_user')->where('email', '=', $email)->count() > 0) {
            return response()->json([
                'status' => '401',
                'msg' => 'This email id already subscribed.',
            ]);
        }

        $saved = Subscriber::create([
            'email' => trim($request->email),
            'ip' => $request->ip(),
        ]);

        if ($saved) {
            return response()->json([
                'status' => '200',
                'msg' => 'Thank You ! You have subscribed successfully for latest updates.',
            ]);
        }

        return response()->json([
            'status' => '401',
            'msg' => 'Something went wrong,please try again.',
        ]);
    }
}
