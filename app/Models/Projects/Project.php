<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes\Product;
use App\Models\Quotes\Service;
use App\Models\Projects\Image;
use SoftDeletes;

class Project extends Model
{
    
    protected $dates = ['deleted_at'];
    protected $table = 'projects';

    public function product(){
        return $this->belongsTo(Product::class, 'product_quotation_id');
    }
    public function service(){
        return $this->belongsTo(Service::class, 'service_quotation_id');
    }
    public function images(){
        return $this->hasMany(Image::class,'project_id');
    }
    
}
