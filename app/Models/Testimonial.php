<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Testimonial (legacy table `tbl_testimonial`). Timestamps managed manually. */
class Testimonial extends Model
{
    protected $table = 'tbl_testimonial';

    public $timestamps = false;

    protected $guarded = ['id'];
}
