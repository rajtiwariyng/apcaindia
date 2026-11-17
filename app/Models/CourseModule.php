<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `course_modules`. Timestamps managed manually by the app. */
class CourseModule extends Model
{
    protected $table = 'course_modules';

    public $timestamps = false;

    protected $guarded = ['id'];
}
