<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

/**
 * Public: standalone header partial endpoints. Ported from the legacy
 * Header\HeaderController.
 */
class HeaderController extends Controller
{
    public function welcome()
    {
        return view('Header::header');
    }

    public function welcomein()
    {
        return view('Header::IN.header');
    }

    public function welcomemy()
    {
        return view('Header::MY.header');
    }
}
