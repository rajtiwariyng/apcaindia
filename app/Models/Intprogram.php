<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_intprogram`. Timestamps managed manually by the app. */
class Intprogram extends Model
{
    protected $table = 'tbl_intprogram';

    public $timestamps = false;

    protected $guarded = ['id'];
}
