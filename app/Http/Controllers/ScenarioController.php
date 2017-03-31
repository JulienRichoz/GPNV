<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livrable;
use DB;
use Redirect;
use App\Models\Scenario;
use App\Models\Event;
use App\Models\AcknowledgedEvent;
use Illuminate\Support\Facades\Auth;

class ScenarioController extends Controller
{
  //show scenario
  function show(/*$element, $checkListType*/)
  {
    return view('scenario.show');
      /*$checkList = new CheckList($element, $checkListType);
      $checkListItems = $checkList->showAll();
      return view('welcome', compact('checkListItems'));*/
  }

  //update checklistItem
  function update(Request $requete,  $id)
  {
    /*CheckList::validate($id, $requete->get('done'));
    return redirect()->back();*/
  }

  //create new scenario item
  function store($projectId, $checkListId, Request $requete)
  {
    Scenario::newItem($checkListId, $requete->get('name'));

    // Logging the scenario creation in the logbook 
    $event = new Event;
    $event->user_id = Auth::user()->id;
    $event->project_id = $projectId;
    $event->description = "Création du scénario \"" . $requete->get('name') . "\"";
    $event->save();
 
    $acknowledgement = new AcknowledgedEvent;
    $acknowledgement->user_id = Auth::user()->id;
    $acknowledgement->event_id = $event->id;
    $acknowledgement->save();

    return redirect()->back();
  }

  //Delete a scenario
  function delete($projectId, Request $requete)
  {
    $scenarioName = Scenario::find($requete->get('scenario'))->name;

    Scenario::destroy($requete->get('scenario'));

    // Logging the scenario removal in the logbook
    $event = new Event;
    $event->user_id = Auth::user()->id;
    $event->project_id = $projectId;
    $event->description = "Suppression du scénario \"" . $scenarioName . "\"";
    $event->save();
 
    $acknowledgement = new AcknowledgedEvent;
    $acknowledgement->user_id = Auth::user()->id;
    $acknowledgement->event_id = $event->id;
    $acknowledgement->save();

    return redirect()->back();
  }

  //addNewItem form
  function addItem($projectId, $checkListId)
  {
    return view("scenario.addItem", ['projectId'=>$projectId, 'checkListId'=>$checkListId]);
  }
}
