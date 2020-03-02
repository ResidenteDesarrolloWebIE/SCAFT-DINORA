<?php

namespace App\Models\UserDetails;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Contact extends Model
{
    protected $dates = ['deleted_at'];
}