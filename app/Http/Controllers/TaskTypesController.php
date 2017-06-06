<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TaskType;


class TaskTypesController extends Controller
{
  function store(TaskType $taskType, Request $request)
  {
      $taskType = new TaskType;
      $taskType->name = $request->input('name');
      $transactionResult = $taskType->save(); // Indicates whether or not the save was successfull

      return view("tasktype.showAll");
  }
}
