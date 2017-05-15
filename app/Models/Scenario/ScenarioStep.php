<?php

namespace App\Models\Scenario;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScenarioStep extends Model
{
  protected $table = 'steps';
  public $timestamps = false;

  public function scenario()
  {
    return $this->belongsTo('App\Models\Scenario\Scenario');
  }

  public function mockup()
  {
    return $this->belongsTo('App\Models\Scenario\Mockup');
  }
}
