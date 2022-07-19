<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie';

    protected $guarded = [];

    public function arrangeMovie(){
        return $this->hasMany('App\Models\Movie', 'id', 'movie_id'); 
    }
}
