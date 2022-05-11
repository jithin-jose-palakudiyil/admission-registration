<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignUserCategoryCollegesCourses extends Model
{
    protected $table = "pivot_user_category_colleges_courses";
    protected $fillable = ['user_id', 'college_id', 'courses_category_id', 'course_id','preference'];
    protected $guarded = [ ];   
}
