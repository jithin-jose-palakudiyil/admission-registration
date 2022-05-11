<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class QuizQuestions extends Model
{
    use SoftDeletes;
    protected $table = "quiz_questions";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
}
