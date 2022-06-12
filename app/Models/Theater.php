<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theater extends Model
{
  protected $table = 'theaters';

  protected $guarded = [];

  use SoftDeletes;

}
