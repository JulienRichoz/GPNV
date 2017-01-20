<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livrable;
use DB;
use Redirect;
use App\Models\CheckList;

class CheckListController extends Controller
{
  function show($element,$checkListType)
  {
      $checkList = new CheckList($element, $checkListType);
      $checkListItems = $checkList->showAll();

      return view('welcome', compact('checkListItems'));
  }

  function update(Request $requete,  $id)
  {
    CheckList::validate($id, $requete->get('done'));
    return redirect()->back();
  }

  function store(Request $requete, $checkListId)
  {
    CheckList::newItem($checkListId, $requete->get('name'), $requete->get('description'));
    return redirect()->back();
  }
}
