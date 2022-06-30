<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // change table name (would be pluralised by default)
    //protected $table = 'posts';
    // change primary key (would be id)
    //public $primaryKey = 'id';
    // timestamps (true by default)
    //public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}

// Post::all();