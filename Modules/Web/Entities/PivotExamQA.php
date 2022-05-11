<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;

class PivotExamQA extends Model
{
    protected $table = "pivot_exam_question_answer";
    protected $fillable = ['quiz_question_id', 'quiz_answer_id', 'exam_id', 'answered','page_no',];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
}
