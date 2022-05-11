<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes; 
class Colleges extends Model
{
    use SoftDeletes;
    protected $table = "colleges";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
    
    //assign colleges to category 
    public function assign_colleges_category()
    {
        return $this->belongsToMany(AssignColleges::class,"pivot_assign_colleges","college_id","courses_category_id") ;
    }
    
    
    public function belongsToCategory()
    {
        return $this->hasMany(AssignColleges::class, 'college_id', 'id');
    }
     
}
