<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_intcontent`. Timestamps managed manually by the app. */
class Intcontent extends Model
{
    protected $table = 'tbl_intcontent';

    public $timestamps = false;

    protected $guarded = ['id'];
}
