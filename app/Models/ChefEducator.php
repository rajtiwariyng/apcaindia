<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Chef educator (legacy table `tbl_chefeducators`). Timestamps managed manually. */
class ChefEducator extends Model
{
    protected $table = 'tbl_chefeducators';

    public $timestamps = false;

    protected $guarded = ['id'];
}
