<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Alumni (legacy table `tbl_alumni`). Timestamps managed manually. */
class Alumni extends Model
{
    protected $table = 'tbl_alumni';

    public $timestamps = false;

    protected $guarded = ['id'];
}
