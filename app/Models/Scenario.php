<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Models\CheckList;

class Scenario extends Model
{
  public $timestamps = false;
  public function objectif()
  {
    return $this->belongsTo('Models\CheckList\Step', 'checkList_item_id');
  }
  //add new item to the checkList
  /*public static function newItem($checkListId, $name, $description=null)
  {
    DB::table('scenarios')->insert(array('name' => $name, 'description' => $description, 'checkList_item_id' => $checkListId));

    //return
  }*/
  //public static function delete()
}
