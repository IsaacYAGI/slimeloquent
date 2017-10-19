<?php

  class Post extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'posts';

    public function user(){
      return $this->belongsTo('User');
    }

  }