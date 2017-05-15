<?php
namespace App\Models\CheckList;
use CheckList;

/**
 *
 */
class Objectif extends CheckList
{
  public function scenarios()
  {
    return $this->hasMany('App\Models\Scenario', 'checkList_item_id');
  }
}

 ?>
