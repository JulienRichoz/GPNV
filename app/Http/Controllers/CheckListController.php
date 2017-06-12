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
use App\Models\Event;
use App\Models\AcknowledgedEvent;
use App\Models\Scenario;
use Illuminate\Support\Facades\Auth;

class CheckListController extends Controller
{
  /**
  * show checkList items
  * @param $element The checkList item
  * @param $checkListTypes The checkList type
  * @return view to see checkList items
  */
  function show($element, $checkListTypes){
      $checkList = new CheckList($element, $checkListTypes);
      $checkListItems = $checkList->showAll();

      return view('welcome', compact('checkListItems'));
  }

  /**
  * show a description of an item
  * @param $projectId The current project id
  * @param $itemId The checkList item id
  * @return view to see checkList item
  */
  function showItem($projectId, $itemId){
    $item = CheckList::getItem($itemId);

    //get scenarios linked to the item
    $scenarios = Scenario::where('checkList_item_id', $item->id)->get();//DB::table('scenarios')->where('checkList_item_id', $item->id)->get();

    return view('checkList.showItem', ['item'=>$item, 'scenarios'=>$scenarios, 'projectId'=>$projectId]);
  }

  /**
  * update checkListItem
  * @param $projectId The current project id
  * @param $id The checkList item id
  * @param $requete Define the request data send by POST
  */
  function update($projectId,  $id, Request $requete){
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

  /**
  * create new checkList item
  * @param $id The current project id
  * @param $checkListId The checkList item id
  * @param $requete Define the request data send by POST
  * @return to previous page
  */
  function store(Request $requete, $id, $checkListId){
    CheckList::newItem($checkListId, $requete->get('name'), $requete->get('description'));
    // Getting the checklist type to display in the logs
    $checkList = DB::table('checkList_Types')->where('id', $checkListId)->first();
    var_dump($checkListId);
    $type = $checkList->name;
    $singularType = substr($type, 0, strlen($type) - 1);
    $formattedType = strtolower($singularType);

    // Defining the preposition that will be used in the log entry according to the checklist type
    $preposition = ($type == "Livrables") ? 'du ' : 'de l\'';

    // Logging the objective creation in the logbook
    $event = new Event;
    $event->user_id = Auth::user()->id;
    $event->project_id = $id;
    $event->description = "Création " . $preposition . $formattedType . " \"" . $requete->get('name') . "\"";
    $event->save();

    $acknowledgement = new AcknowledgedEvent;
    $acknowledgement->user_id = Auth::user()->id;
    $acknowledgement->event_id = $event->id;
    $acknowledgement->save();

    return redirect()->back();
  }

  /**
  * Unlink checklist item
  * @param $checkListId The checkList item id
  */
  function unlink($checkListID){
    $checkListItem = DB::table('checkList_Items')->where('id', $checkListID)->update(['link' => '']);
  }

}
