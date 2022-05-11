<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes; 

class Board extends Model
{
    
//    use SoftDeletes;
    protected $table = "board";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
    
}
