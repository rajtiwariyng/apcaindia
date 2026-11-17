<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Legacy table `tbl_faqs`. Timestamps managed manually by the app. */
class Faq extends Model
{
    protected $table = 'tbl_faqs';

    public $timestamps = false;

    protected $guarded = ['id'];
}
