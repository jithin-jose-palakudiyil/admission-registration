<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AssignCategoryCollege extends Model
{
    protected $table = "pivot_assign_category_colleges";
    protected $fillable = [];
    protected $guarded = [ ];   
    



    public function GetCourses()
    {
        return $this->belongsTo(\Modules\Web\Entities\Courses::class, 'course_id', 'id');
    }

}
