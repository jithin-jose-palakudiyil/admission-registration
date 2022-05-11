<?php

namespace Modules\Colleges\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class NewApplications extends Model
{
    use SoftDeletes;
    protected $table = "new_applications";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
    
    public function hasForms()
    { 
        return $this->hasOne(\Modules\Colleges\Entities\Forms::class, 'id', 'form_id');
    }
    
}
