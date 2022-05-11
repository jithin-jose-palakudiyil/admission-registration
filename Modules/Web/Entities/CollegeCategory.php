<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeCategory extends Model
{
    use SoftDeletes;
    protected $table = "college_category";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
}
