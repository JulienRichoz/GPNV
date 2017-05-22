<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScenarioStep extends Model
{
  protected $table = 'steps';
  public $timestamps = false;

  public function scenario()
  {
    return $this->belongsTo('App\Models\Scenario');
  }

  public function mockup()
  {
    return $this->belongsTo('App\Models\Mockup');
  }
}
