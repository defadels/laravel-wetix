<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArrangeMovie extends Model
{
    protected $table = 'arrange_movie';

    // protected $guarded = [];

    public function movies(){
        return $this->hasMany('App\Models\Movie', 'id', 'movie_id');
    }
}
