<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Newsletter subscriber (legacy table `subscribed_user`, legacy model "Footer").
 * Timestamps left ON (legacy default), matching the original save() behavior.
 */
class Subscriber extends Model
{
    protected $table = 'subscribed_user';

    protected $fillable = ['name', 'email', 'ip', 'created_at', 'updated_at'];
}
