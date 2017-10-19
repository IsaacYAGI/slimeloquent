<?php

  class User extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'users';


    public function posts(){
      return $this->hasMany('Post');
    }
  }