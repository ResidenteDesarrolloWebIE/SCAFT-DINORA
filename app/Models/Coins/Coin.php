<?php

namespace App\Models\Coins;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Coin extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'cat_coins';
}