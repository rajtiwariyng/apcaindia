<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_homeprogram`. Timestamps managed manually by the app. */
class HomeProgram extends Model
{
    protected $table = 'tbl_homeprogram';

    public $timestamps = false;

    protected $guarded = ['id'];
}
