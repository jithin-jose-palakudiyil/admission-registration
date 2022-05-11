<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Foundation\Auth\User as Authenticatable;

class Auth extends Authenticatable
{
   use SoftDeletes;
    protected $table = "admin_users";
    protected $fillable = [];
    protected $guarded = [ ];
    protected $hidden = ['password']; 
    protected $dates = ['deleted_at'];
}
