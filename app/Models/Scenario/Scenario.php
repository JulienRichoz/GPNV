<?php

namespace App\Models\Scenario;

use Illuminate\Database\Eloquent\Model;
use DB;
use Models\CheckList;

class Scenario extends Model
{
  public $timestamps = false;
  public function objectif()
  {
    return $this->belongsTo('App\Models\CheckList\Step', 'checkList_item_id');
  }
  public function mockups()
  {
    return $this->hasMany('App\Models\Scenario\Scenario');
  }
}
