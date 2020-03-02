<?php
namespace App\Models\Quotes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes\Progress;
use SoftDeletes;

class Progress extends Model
{

    protected $dates = ['deleted_at'];
    protected $table = 'quotation_progress';
    
}
