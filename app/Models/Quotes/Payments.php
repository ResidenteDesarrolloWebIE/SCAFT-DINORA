<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Payments extends Model
{
    
    protected $dates = ['deleted_at'];
    protected $table = 'quotation_payments';

}
