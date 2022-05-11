<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Quiz extends Model
{
    use SoftDeletes;
    protected $table = "quiz";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
    
    /**
     * Get the questions for the Quiz post.
     */
    public function questions()
    {
        return $this->hasMany(QuizQuestions::class,'quiz_id','id');
    }
}
