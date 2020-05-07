<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    // Relación One To Many
    public function comments(){
      return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    //Relación Many To One
    public function user(){
      return $this->belongsTo('App\User','user_id');
    }
}
