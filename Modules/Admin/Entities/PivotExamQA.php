<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use \Modules\Admin\Entities\QuizQuestions;
use \Modules\Admin\Entities\QuizAnswers;


class PivotExamQA extends Model
{
    protected $table = "pivot_exam_question_answer";
    protected $fillable = ['quiz_question_id', 'quiz_answer_id', 'exam_id', 'answered','page_no',];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];



    public function getQuestion()
    {
        return $this->belongsTo(QuizQuestions::class, 'quiz_question_id', 'id');
    }

    public function getAnswer()
    {
        return $this->belongsTo(QuizAnswers::class, 'quiz_answer_id', 'id');
    }
}
