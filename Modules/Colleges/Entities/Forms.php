<?php

namespace Modules\Colleges\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Forms extends Model
{
    use SoftDeletes;
    protected $table = "forms";
    protected $fillable = [];
    protected $guarded = [ ]; 
    protected $dates = ['deleted_at'];
}
