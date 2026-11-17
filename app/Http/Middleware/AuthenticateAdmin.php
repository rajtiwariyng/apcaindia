<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Admin session guard.
 *
 * Single-point replacement for the `Session::get('sessionadmin')` check that
 * was copy-pasted into ~60 controller methods in the legacy app. The session
 * key `sessionadmin` is populated by Admin\AuthController::loginCheck() on a
 * successful login.
 *
 * Legacy redirect targets were inconsistent (AdminController -> /admin-login,
 * sub-controllers -> /). This unifies them to /admin-login (the login page).
 */
class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('sessionadmin')) {
            return redirect('/admin-login');
        }

        return $next($request);
    }
}
