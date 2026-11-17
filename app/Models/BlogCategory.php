<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_blog_category`. Timestamps managed manually by the app. */
class BlogCategory extends Model
{
    protected $table = 'tbl_blog_category';

    public $timestamps = false;

    protected $guarded = ['id'];
}
