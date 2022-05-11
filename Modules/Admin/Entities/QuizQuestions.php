<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestions extends Model
{
    use SoftDeletes;
    protected $table = "quiz_questions";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
    
    /**
     * Get the Answers for the Quiz Questions.
     */
    public function hasManyAnswers()
    {   
        return $this->hasMany(QuizAnswers::class, 'quiz_question_id');
    }
    
     
}
