<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CheckList extends Model
{
  private $tableName="";
  private $checkListType="";
  private $items="";
  private $nbItems=0;
  private $nbDone=0;

  function __construct($elementName, $elementId, $checkListType)
  {
    $this->tableName = $elementName;
    $this->checkListType = $checkListType;

    $tableId = DB::table('CheckListTables')->where('name', $elementName)->get();
    $typeId = DB::table('CheckListTypes')->where('name', $checkListType)->get();
    if(isset($tableId[0]) && isset($typeId[0]))
    {
      $listeId = DB::table('CheckListLinkedTo')->where([['fkTable', '=', $tableId[0]->id],
      ['fkType', '=', $typeId[0]->id], ['recordId','=', $elementId]])->get();
      if(isset($listeId[0]))
      {
        $checkList = DB::table('CheckListItems')->where('fkLinkedTo',$listeId[0]->id)->get();
        foreach ($checkList as $checkListItem)
        {
          $this->nbItems++;
          if($checkListItem->done)
            $this->nbDone++;
          $this->items[] = $checkListItem;
        }
      }
    }
  }

  public function getNbItems()
  {
    return $this->nbItems;
  }
  public function getNbItemsDone()
  {
    return $this->nbDone;
  }
  public function getCompletedPercent()
  {
    if($this->nbItems>0)
      return $this->nbDone/$this->nbItems*100;
    else
      return 0;
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
    if(isset($done))
    {
      $done = 1;
    }
    else
    {
      $done = 0;
    }

    DB::table('CheckListItems')->where('id',$id)->update(array('done'=>$done));
  }
  public static function newItem($checkListId, $title, $description)
  {
    DB::table('CheckListItems')->insert(array('title' => $title, 'description' => $description, 'done' => 0, 'fkLinkedTo' => $checkListId));
  }
}
