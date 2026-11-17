<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_homeslider`. Timestamps managed manually by the app. */
class HomeSlider extends Model
{
    protected $table = 'tbl_homeslider';

    public $timestamps = false;

    protected $guarded = ['id'];
}
