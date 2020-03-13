<?php
namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Revisions\RevisionSupply;
use App\Models\UserDetails\Contact;
use App\Models\Projects\Project;
use App\Models\Quotes\Progress;
use App\Models\Quotes\Payments;
use SoftDeletes;
use App\User;

class Product extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'products_quotations';
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->hasOne(Project::class,'product_quotation_id');
    }
    
    public function contacts(){
        return $this->hasMany(Contact::class,'id');
    }


        /* Metodos para las revisiones */
    public function revisions(){
        return $this->hasMany(RevisionSupply::class,'product_quotation_id');
    }
    public function orderedReviews(){
        return $this->hasMany(RevisionSupply::class,'product_quotation_id')->orderBy('revision_number','desc');/* ->take(1) */
    }
        /* Metodos para el progreso */
    public function progress(){
        return $this->hasOne(Progress::class,'product_quotation_id');
    }
        /* Metodos para los pagos */
    public function payments(){
        return $this->hasMany(Payments::class,'product_quotation_id');
    }
}