<?php

namespace Modules\Colleges\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $fillable = [];
    protected $guarded = [ ];
    protected $dates = ['deleted_at'];
}
