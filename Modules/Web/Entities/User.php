<?php

namespace Modules\Web\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "users";  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'otp',
        'otp_created_at',
        'otp_updated_at',
        'is_otp_sent',
        'gender',
        'address',
        'district',
        'pincode',
        'date_of_birth',
        'caste_category',
        'mobile',
        'whatsapp',
        'parent_name',
        'parent_contact',
        'class_completed',
        'last_studied',
        'board',
        'annual_income',
        'reset_otp',
        'reset_otp_created_at',
        'reset_otp_updated_at',
        'reset_token',
        'reset_token_created_at',
        'reset_token_updated_at',
        'current_step',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
