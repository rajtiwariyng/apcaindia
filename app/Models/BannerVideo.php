<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `banner_videos`. Timestamps managed manually by the app. */
class BannerVideo extends Model
{
    protected $table = 'banner_videos';

    public $timestamps = false;

    protected $guarded = ['id'];
}
