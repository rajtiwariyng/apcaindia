<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_content`. Timestamps managed manually by the app. */
class Content extends Model
{
    protected $table = 'tbl_content';

    public $timestamps = false;

    protected $guarded = ['id'];
}
