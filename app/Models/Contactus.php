<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Contact enquiry (legacy table `contactus`).
 *
 * Eloquent timestamps are left ON (matching the legacy Contactus model, which
 * did not disable them), so create() stamps created_at/updated_at.
 */
class Contactus extends Model
{
    protected $table = 'contactus';

    protected $fillable = [
        'full_name', 'email', 'mobile', 'date_time',
        'program', 'privacy', 'questions', 'page_name',
    ];
}
