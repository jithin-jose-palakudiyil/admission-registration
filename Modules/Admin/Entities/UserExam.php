<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use \Modules\Admin\Entities\User;
use \Modules\Admin\Entities\Quiz;


class UserExam extends Model
{
    use SoftDeletes;
    protected $table = "user_exam";
    protected $fillable = ['user_id', 'quiz_id', 'current_question_id', 'quiz_status', 'react_route_name', 'page_no'];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];


    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function getQuiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function getAttendedQuizAnswer()
    {
        return $this->hasMany(PivotExamQA::class, 'exam_id', 'id');
    }
}
