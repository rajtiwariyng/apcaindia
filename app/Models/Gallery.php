<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Photo gallery item (legacy table `tbl_gallery`). Timestamps managed manually. */
class Gallery extends Model
{
    protected $table = 'tbl_gallery';

    public $timestamps = false;

    protected $guarded = ['id'];
}
