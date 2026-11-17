<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_pdf`. Timestamps managed manually by the app. */
class Pdf extends Model
{
    protected $table = 'tbl_pdf';

    public $timestamps = false;

    protected $guarded = ['id'];
}
