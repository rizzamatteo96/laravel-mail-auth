<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id'
    ];

    // Creo la relazione con la tabella delle categorie
    public function postCategory(){
        return $this->belongsTo('App\Category','category_id','id');
    }

    // Creo la relazione con la tabella dei tag
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
