<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TaskType;


class TaskTypesController extends Controller
{
  /**
  * Create a new task type
  * @param $taskType The task type object
  * @param $request Define the request data send by POST
  * @return view all task type
  */
  function store(TaskType $taskType, Request $request)
  {
      $taskType = new TaskType;
      $taskType->name = $request->input('name');
      $transactionResult = $taskType->save(); // Indicates whether or not the save was successfull

      return view("tasktype.showAll");
  }
}
