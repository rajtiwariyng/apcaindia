<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Admin authentication + dashboard.
 *
 * Behavior ported verbatim from the legacy AdminController / Admin model:
 *  - Credentials are checked against the `users` table using md5() hashing.
 *    (md5 is insecure; replacing it requires a hash migration and is tracked as
 *    separate, confirmed security work — NOT changed here to preserve login.)
 *  - On success a `sessionadmin` array (userid/name/email) is stored in session.
 */
class AuthController extends Controller
{
    public function login()
    {
        return view('Admin::login');
    }

    public function loginCheck(Request $request)
    {
        $email = trim((string) $request->input('email'));
        $password = trim((string) $request->input('password'));

        if ($email === '' || $password === '') {
            return response()->json([
                'status' => '401',
                'msg' => 'All field are required',
            ]);
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'status' => '401',
                'msg' => 'Invalid E-mail',
            ]);
        }

        $user = DB::table('users')
            ->where('email', '=', $email)
            ->where('password', '=', md5($password))
            ->first();

        if ($user === null) {
            return response()->json([
                'status' => '401',
                'msg' => 'Sorry! Entered Username or password is incorrect.',
            ]);
        }

        $request->session()->put('sessionadmin', [
            'userid' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return response()->json([
            'status' => '200',
            'msg' => 'Successfully logged in, Redirecting...',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/admin-login');
    }

    public function dashboard()
    {
        $blogsCount = DB::table('tbl_blog')->where('status', '=', 1)->count();
        $testimonial = DB::table('tbl_testimonial')->where('status', '=', 1)->count();
        $placementpartners = DB::table('tbl_placementpartners')->where('status', '=', 1)->count();
        $supportingbrands = DB::table('tbl_supportingbrands')->where('status', '=', 1)->count();
        $chefeducators = DB::table('tbl_chefeducators')->where('status', '=', 1)->count();
        $alumni = DB::table('tbl_alumni')->where('status', '=', 1)->count();
        $intprogram = DB::table('tbl_intprogram')->where('status', '=', 1)->count();
        $contactus = DB::table('contactus')->count();

        $topPages = DB::table('page_views')
            ->select('url', DB::raw('COUNT(*) as count'))
            ->groupBy('url')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        foreach ($topPages as $page) {
            $page->friendly_name = $this->convertUrlToTitle($page->url);
        }

        return view('Admin::dashboard', compact(
            'blogsCount',
            'testimonial',
            'contactus',
            'placementpartners',
            'supportingbrands',
            'chefeducators',
            'alumni',
            'intprogram',
            'topPages'
        ));
    }

    private function convertUrlToTitle(string $url): string
    {
        $url = trim($url, '/');

        if ($url === '') {
            return 'Home';
        }

        $url = str_replace(['-', '/'], ' ', $url);

        return ucwords($url);
    }
}
