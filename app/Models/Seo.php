<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SEO metadata per page/url (legacy table `tbl_seo`).
 *
 * Timestamps managed manually by the application (see Blog model note).
 */
class Seo extends Model
{
    protected $table = 'tbl_seo';

    public $timestamps = false;

    protected $fillable = [
        'url_slug',
        'page_name',
        'seo_title',
        'seo_desc',
        'seo_keywords',
        'created_at',
        'updated_at',
    ];
}
