<?php

namespace App\Models\Revisions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Coins\Coin;
use SoftDeletes;

class RevisionService extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'revisions_services';

    public function coin(){
        return $this->belongsTo(Coin::class, 'cat_coin_id');
    }
}
