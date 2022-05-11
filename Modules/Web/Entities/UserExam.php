<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class UserExam extends Model
{
    use SoftDeletes;
    protected $table = "user_exam";
    protected $fillable = ['user_id', 'quiz_id', 'current_question_id', 'quiz_status', 'react_route_name', 'page_no', 'question_array'];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
}
