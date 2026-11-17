<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `courses`. Timestamps managed manually by the app. */
class Course extends Model
{
    protected $table = 'courses';

    public $timestamps = false;

    protected $guarded = ['id'];
}
