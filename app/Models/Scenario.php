<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Scenario extends Model
{
  public $timestamps = false;
  public function steps()
  {
    return $this->hasMany('App\Models\ScenarioStep');
  }
  public function mockups(){
    return $this->hasMany('App\Models\Mockup');
  }
}
