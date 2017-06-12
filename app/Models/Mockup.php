<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mockup extends Model
{
  public $timestamps = false;
  public function project(){
    return $this->belongsTo('App\Models\Project');
  }
}
