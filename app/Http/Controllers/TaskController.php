<?php

namespace App\Http\Controllers;

use App\Models\DurationsTask;
use App\Models\UsersTask;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Models\User;
use App\Models\Event;
use App\Models\AcknowledgedEvent;


use App\Http\Requests;

class TaskController extends Controller
{
    // Return the view task
    function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    // Return the view about the creation a children task
    function createChildren(Task $task)
    {
        return view('task.createChildren', ['task' => $task]);
    }

    // Return the view about the creation a root task
    function create(Task $task, Request $request)
    {
        return view('task.create', ['task' => $task]);
    }

    // Create a new task
    function storeChildren(Task $task, Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->input('name');
        $newTask->duration = $request->input('duration');
        $newTask->project_id = $request->input('project_id');
        $newTask->parent_id = $request->input('parent_id');
        $newTask->status = "todo"; // hardcoded until the UI allows user friendly status changes
        $transactionResult = $newTask->save(); // Indicates whether or not the save was successfull

        //modified By: Fabio Marques
        $parentTask = Task::find($request->input('parent_id'));
        foreach ($parentTask->usersTasks as  $usertask) {
          $usertask->delete();
        }

        // return redirect()->route("project.show", ['id'=>$task->project_id]);
        return json_encode($transactionResult);
    }

    // Delete a task
    function destroy(Task $task)
    {
        //Modified By: Fabio Marques
        foreach ($task->usersTasks as  $usertask) {
          $usertask->delete();
        }
        $task->delete();

        (new EventController())->store($request->input('project_id'), "Supprimer une tâche"); // Create an event

        return ("destroy" . $task);
    }

    // Return the view about the edition
    function edit(Task $task, Request $request)
    {
        return view('task.edit', ['task' => $task]);
    }

    //
    function store(Task $task, Request $request)
    {
        $task->update([
            'name' => $request->input('name'),
            'duration' => $request->input('duration'),
            'parent_id' => $request->input('parent_id') == '' ? null : $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);

        //(new EventController())->store($request->input('project_id'), "Créer une tâche enfant"); // Create an event

        return redirect()->route("project.show", ['id'=>$task->project_id]);
    }

    // Start a task
    public function play(Request $request)
    {
        $durationTask = new DurationsTask;
        $durationTask->user_task_id = $request->task;

        $user = Auth::user();
        if (!$user->getActiveTask()->isEmpty()) {
            return "";
        }

        $durationTask->save();
        return $durationTask->id;
    }

    // Stop a task
    public function stop(DurationsTask $durationsTask)
    {
        $now = new DateTime(); // Add the current time in a variable $now

        // Update the duration with the current time
        $durationsTask->update([
            'ended_at' => $now,
        ]);
    }

    // Display the users with a common task
    public function users(Task $task, Request $request){

        $usersTasks = $task->usersTasks;
        $refuse = [];
        foreach($task->project->users as $user){
            foreach($task->usersTasks as $usertask){
                if($usertask->user_id == $user->id){
                    $refuse[] = $usertask->user_id;
                }else{
                }
            }
        }

        return view('task.users', ['task' => $task,'userstask' => $usersTasks, 'project' => $task->project, 'refuse' => $refuse]);
    }

    // Add one or more users for a task
    public function storeUsers(Task $task, Request $request){

        foreach($request->input('user') as $key => $value){
            $newUserTask = new UsersTask();
            $newUserTask->task_id = $request->task->id;
            $newUserTask->user_id = $key;
            $newUserTask->save();
        }

        return redirect()->route("project.show", ['id'=>$task->project_id]);
    }

    // Delete a user of task
    public function userTaskDelete(UsersTask $usersTask, Request $request){
        $taskName = $usersTask->task->name;
        $taskUser = $usersTask->user->firstname . " " . $usersTask->user->lastname;
        $usersTask->delete();

        $event = new Event;
        $event->user_id = Auth::user()->id;
        $event->project_id = $request->projectId;
        $event->description = "Abandon de la tâche \"" . $taskName . "\" par: " . $taskUser . ". Raison: " . $request->comment;
        $event->save();

        // relationship management
        $relation = new AcknowledgedEvent;
        $relation->event_id = $event->id;
        $relation->user_id = Auth::user()->id;
        $relation->save();
    }


    // Verify the validity of task
    public function status(Task $task, Request $request){

        if(!$task->ifChildTaskNoValidate()){ // Return a error message

            dd("La tâche ne peut pas être validée");

        }else{ // Return a message

            $task->update([
                'status' => 'validate',
            ]);

            dd("La tâche peut être validée");

        }
    }



}
