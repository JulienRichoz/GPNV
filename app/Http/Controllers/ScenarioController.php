<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livrable;
use DB;
use Redirect;
use App\Models\Scenario;

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
    return redirect()->back();
  }

  //addNewItem form
  function addItem($projectId, $checkListId)
  {
    return view("scenario.addItem", ['projectId'=>$projectId, 'checkListId'=>$checkListId]);
  }
}
