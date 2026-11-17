<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_intprogram_page`. Timestamps managed manually by the app. */
class IntprogramPage extends Model
{
    protected $table = 'tbl_intprogram_page';

    public $timestamps = false;

    protected $guarded = ['id'];
}
