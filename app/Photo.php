<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = '/images/';

    protected $fillable = [
        'name'
    ];

    public function user(){
        return $this->hasOne('App\User');
    }

    public function post(){
        return $this->hasOne('App\Post');
    }

    public function getNameAttribute($value){
        return url('/') .$this->uploads . $value;
    }
}
