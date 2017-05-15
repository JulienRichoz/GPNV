<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livrable;
use DB;
use Redirect;
use App\Models\Scenario;
use App\Models\ScenarioStep;
use App\Models\Event;
use App\Models\AcknowledgedEvent;
use Illuminate\Support\Facades\Auth;

class ScenarioController extends Controller
{
  //show scenario
  function show($projectId, $scenarioId)
  {
    $scenario = Scenario::find($scenarioId);
    return view('scenario.show', ['projectId'=>$projectId, 'scenario'=>$scenario]);
  }

  //update scenario
  function update($projectId, $scenarioId, Request $requete)
  {
    $scenario = Scenario::find($scenarioId);
    $scenario->name = $requete->name;
    $scenario->description = $requete->description;
    if($requete->actif && $requete->actif=='on')
      $scenario->actif = 1;
    else
      $scenario->actif = 0;
    $scenario->save();

    return redirect()->back();
  }

  //create new scenario item
  function store($projectId, $checkListId, Request $requete)
  {
    $scenario = new Scenario();
    $scenario->name = $requete->name;
    $scenario->checkList_item_id = $checkListId;
    $scenario->save();
    //$scenarioId = Scenario::newItem($checkListId, $requete->get('name'));

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

    return redirect()->route('scenario.show', ['projectId'=>$projectId, 'scenarioId'=>$scenario->id]);
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

  function addStep($projectId, $scenarioId, Request $requete)
  {
    $order = ScenarioStep::where('scenario_id', $scenarioId)->max('order')+1;

    $step = new ScenarioStep;
    $step->action = $requete->action;
    $step->result = $requete->reponse;
    $step->order = $order;
    $step->scenario_id = $scenarioId;

    $step->save();

    return redirect()->back();

  }

  function delStep($projectId, $stepId)
  {
    DB::table('steps')->delete($stepId);
    return redirect()->back();
  }

  //update scenarioItem
  function updateStep($projectid, $scenarioId, $itemId, Request $requete)
  {
    DB::table('steps')->where('id', $itemId)->update(array('order'=>$requete->order, 'action'=>$requete->action, 'result'=>$requete->reponse));
    return redirect()->back();
  }

  function addMaquete($projectid, $scenarioId, Request $requete)
  {
    $scenario = Scenario::find($scenarioId);
    $objectifId = $scenario->objectif->id;
  }
}
