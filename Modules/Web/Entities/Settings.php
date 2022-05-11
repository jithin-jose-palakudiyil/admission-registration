<?php

namespace Modules\Web\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use SoftDeletes;
    protected $table = "settings"; 
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    protected $guarded = [ ];
}
