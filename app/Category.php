<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    // Creo la relazione con la tabella dei post
    public function categoryPost(){
        return $this->hasMany('App\Post');
    }
}
