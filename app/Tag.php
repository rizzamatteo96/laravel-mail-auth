<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Creo la relazione con la tabella dei post
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
