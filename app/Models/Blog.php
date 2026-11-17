<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Blog post (legacy table `tbl_blog`).
 *
 * Timestamps are managed manually by the application (the legacy code writes
 * `date("Y-m-d h:i:s")` into created_at/updated_at), so Eloquent's automatic
 * timestamp handling is disabled to preserve the exact stored format.
 */
class Blog extends Model
{
    protected $table = 'tbl_blog';

    public $timestamps = false;

    protected $fillable = [
        'uniqueid',
        'title',
        'blog_short_desc',
        'description',
        'image',
        'category',
        'slug',
        'status',
        'created_at',
        'updated_at',
        'ip',
        'metatitle',
        'metakeywords',
        'metadesc',
        'view_count',
        'email_sent',
        'img_alt',
    ];
}
