<?php
/* Created By: Fabio Marques
  Description: Model to interact with the checkList
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CheckList extends Model
{
  private $items=[];
  private $nbItems=0;
  private $nbDone=0;
  private $checkListId="";
  private $name="";

  //initialize a checkList
  function __construct($elementName, $elementId, $checkListType)
  {
    $tableId = DB::table('checkList_Tables')->where('name', $elementName)->first();
    $typeId = DB::table('checkList_Types')->where('name', $checkListType)->first();
    if(isset($tableId) && isset($typeId))
    {
      $this->name = $typeId->name;
      $listeId = DB::table('checkLists')->where([['checkListTable_id', '=', $tableId->id],
      ['checkListType_id', '=', $typeId->id], ['recordId','=', $elementId]])->first();
      if(isset($listeId))
      {
        $this->checkListId = $listeId->id;
        $checkList = DB::table('checkList_Items')->where('checkList_id',$listeId->id)->get();
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

  //return the checkList name
  public function getName()
  {
    return $this->name;
  }
  // return the checkList id
  public function getId()
  {
    return $this->checkListId;
  }

  // return de nb of items
  public function getNbItems()
  {
    return $this->nbItems;
  }

  //return the nb of done items
  public function getNbItemsDone()
  {
    return $this->nbDone;
  }

  //return the completed Percent from the checkList
  public function getCompletedPercent()
  {
    if($this->nbItems>0)
      return $this->nbDone/$this->nbItems*100;
    else
      return 0;
  }

  //return all items
  public function showAll(){
    return $this->items;
  }

  //return completed items
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

  //return items toDo
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

  //validate an item
  public static function validate($id, $done)
  {
    if(isset($done))
      $done = 1;
    else
      $done = 0;

    DB::table('checkList_Items')->where('id',$id)->update(array('done'=>$done));
  }

  //add new item to the checkList
  public static function newItem($checkListId, $title, $description=null)
  {
    DB::table('checkList_Items')->insert(array('title' => $title, 'description' => $description, 'done' => 0, 'checkList_id' => $checkListId));
  }

  //create a new checkList
  public static function newcheckList($tableName, $recordId, $typeName)
  {
    $tableId = DB::table('checkList_Tables')->where('name', $tableName)->value('id');
    $typeId = DB::table('checkList_Types')->where('name', $typeName)->value('id');

    if(!isset($tableId))
      $tableId = DB::table('checkList_Tables')->insertGetId(array('name' => $tableName));

    if(!isset($typeId))
      $typeId = DB::table('checkList_Types')->insertGetId(array('name' => $typeName));

    DB::table('checkLists')->insert(array('recordId' => $recordId, 'checkListTable_id' => $tableId, 'checkListType_id' => $typeId));
  }
}
