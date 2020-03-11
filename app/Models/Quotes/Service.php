<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Projects\Project;
use App\Models\Revisions\RevisionService;
use App\Models\UserDetails\Contact;
use App\Models\Quotes\Progress;
use App\Models\Quotes\Payments;
use App\User;
use SoftDeletes;

class Service extends Model
{
    protected $table = 'services_quotations';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function project(){
        return $this->hasOne(Project::class,'service_quotation_id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class,'id');
    }


    /* Metodos para las revisiones */
    public function revisions(){
        return $this->hasMany(RevisionService::class,'service_quotation_id');
    }
    public function orderedReviews(){
        return $this->hasMany(RevisionService::class,'service_quotation_id')->orderBy('revision','desc')->take(1);
    }
    /* Metodos para el progreso */
    public function progress(){
        return $this->hasOne(Progress::class,'service_quotation_id');
    }
    /* Metodos para los pagos */
    public function payments(){
        return $this->hasMany(Payments::class,'service_quotation_id');
    }

}
