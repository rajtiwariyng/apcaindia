<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Supporting brand (legacy table `tbl_supportingbrands`). Timestamps managed manually. */
class SupportingBrand extends Model
{
    protected $table = 'tbl_supportingbrands';

    public $timestamps = false;

    protected $guarded = ['id'];
}
