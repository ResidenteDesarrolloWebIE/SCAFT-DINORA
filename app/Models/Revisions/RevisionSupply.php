<?php

namespace App\Models\Revisions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Coins\Coin;
use SoftDeletes;

class RevisionSupply extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'revisions_supplies';

    public function coin(){
        return $this->belongsTo(Coin::class, 'cat_coin_id');
    }
}
