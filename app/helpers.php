<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Global helper functions (ported from the legacy app)
|--------------------------------------------------------------------------
|
| These mirror helpers the legacy Laravel 7 app exposed globally
| (app/Helpers/functions.php and app/Modules/Admin/helpers.php) so that
| ported views/controllers behave identically.
*/

if (! function_exists('random_unique_id')) {
    /**
     * Faithful replacement for the legacy global constant `randomnumber`
     * (defined once per request as: rand(10,100) . uniqid()).
     *
     * The legacy value was a per-request constant; here we generate a fresh
     * value per call, which yields the same format and is unique per record.
     */
    function random_unique_id(): string
    {
        return random_int(10, 100).uniqid();
    }
}

if (! function_exists('record_page_view')) {
    /**
     * Log a front-end page view (ported from the inline page_views inserts that
     * were duplicated across the public controllers).
     */
    function record_page_view(Request $request): void
    {
        DB::table('page_views')->insert([
            'url' => $request->path(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

if (! function_exists('encode')) {
    function encode(string $arg): string
    {
        return base64_encode($arg);
    }
}

if (! function_exists('decode')) {
    function decode(string $arg): string
    {
        return base64_decode($arg);
    }
}

if (! function_exists('getExcerpt')) {
    function getExcerpt(string $str, int $startPos = 0, int $maxLength = 50): string
    {
        if (strlen($str) > $maxLength) {
            $excerpt = substr($str, $startPos, $maxLength - 3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt = substr($excerpt, 0, $lastSpace);
            $excerpt .= ' ...';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }
}
