<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Scenario extends Model
{
  //add new item to the checkList
  public static function newItem($checkListId, $name, $description=null)
  {
    DB::table('scenarios')->insert(array('name' => $name, 'description' => $description, 'checkList_item_id' => $checkListId));
  }
}
