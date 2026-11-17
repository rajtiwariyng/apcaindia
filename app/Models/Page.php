<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_pages`. Timestamps managed manually by the app. */
class Page extends Model
{
    protected $table = 'tbl_pages';

    public $timestamps = false;

    protected $guarded = ['id'];
}
