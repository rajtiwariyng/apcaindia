<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Placement partner (legacy table `tbl_placementpartners`). Timestamps managed manually. */
class PlacementPartner extends Model
{
    protected $table = 'tbl_placementpartners';

    public $timestamps = false;

    protected $guarded = ['id'];
}
