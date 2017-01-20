<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CheckList extends Model
{
  private $tableName="";
  private $checkListType="";
  private $items="";
  function __construct($tableName, $checkListType)
  {
    $this->tableName = $tableName;
    $this->checkListType = $checkListType;

    $tableId = DB::table('CheckListTables')->where('name', $tableName)->get();
    $typeId = DB::table('CheckListTypes')->where('name', $checkListType)->get();
    $listeId = DB::table('CheckListLinkedTo')->where([['fkTable', '=', $tableId[0]->id],
    ['fkType', '=', $typeId[0]->id]])->get();

    $checkList = DB::table('CheckListItems')->where('fkLinkedTo',$listeId[0]->recorId)->get();
    foreach ($checkList as $checkListItem)
    {
      $this->items[] = $checkListItem;
    }
  }

  public function showAll(){
    return $this->items;
  }

  public function showCompleted(){
    $tmp="";
    foreach ($this->items as $item) {
      if($item->done)
      {
        $tmp[]=$item;
      }
    }
    return $tmp;
  }

  public function showToDo(){
    $tmp="";
    foreach ($this->items as $item) {
      if(!$item->done)
      {
        $tmp[]=$item;
      }
    }
    return $tmp;
  }
  public static function validate($id, $done)
  {
    if(isset($done)) $done = 1;
    else $done = 0;

    DB::table('CheckListItems')->where('id',$id)->update(array('done'=>$done));
  }
}
