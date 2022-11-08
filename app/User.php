<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active','photo_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function isAdmin(){
        if($this->role->id == 1){
            return true;
        }
        return false;
    }
    public function isActive(){
        if($this->is_active == 1){
            return true;
        }
        return false;
    }
}
