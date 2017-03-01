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

  //update checkListItem
  function update(Request $requete,  $id)
  {
    CheckList::validate($id, $requete->get('done'));
    return redirect()->back();
  }

  //create new checkList item
  function store(Request $requete, $checkListId)
  {
    CheckList::newItem($checkListId, $requete->get('name'), $requete->get('description'));
    return redirect()->back();
  }
}
