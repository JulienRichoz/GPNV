<?php
/* Created By: Fabio Marques
  Description: Model to interact with the checkList
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livrable;
use DB;
use Redirect;
use App\Models\CheckList;

class CheckListController extends Controller
{
  //show checkList items
  function show($element, $checkListTypes)
  {
      $checkList = new CheckList($element, $checkListTypes);
      $checkListItems = $checkList->showAll();

      return view('welcome', compact('checkListItems'));
  }

  // show a description of an item
  function showItem($projectId, $itemId){
    $item = CheckList::getItem($itemId);

    //get scenarios linked to the item
    $scenarios = DB::table('scenarios')->where('checkList_item_id', $item->id)->get();

    return view('checkList.showItem', ['item'=>$item, 'scenarios'=>$scenarios, 'projectId'=>$projectId]);
  }

  //update checkListItem
  function update($projectId,  $id, Request $requete)
  {
    if(null !== $requete->get('validate'))
    {
      CheckList::validate($id, $requete->get('done'));
    }
    else
    {
      CheckList::updateItem($id,$requete);
    }
    return redirect()->back();
  }

  //create new checkList item
  function store(Request $requete, $id, $checkListId)
  {
    CheckList::newItem($checkListId, $requete->get('name'), $requete->get('description'));
    return redirect()->back();
  }
}
