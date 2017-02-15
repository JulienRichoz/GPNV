<?php

namespace App\Http\Controllers;

use App\Models\ProjectsUser;
use Illuminate\Http\Request;
use App\Models\UsersTask;
use App\Models\Project;
use App\Models\Comment;
use App\Models\User;
use App\Models\Task;
use App\Models\Event;
use App\Http\Requests;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Form;
use Datetime;
use App\Models\Target;
use App\Models\CheckList;
use App\Models\EventsUser;
use DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('ProjectControl', ['except' => [
            'index', 'create', 'store', 'valideTarget'
        ]]);
    }


    public function index()
    {
        // If the user has a role like "Eleve", he can access student view and he only can see his projects
        if (Auth::user()->role->name == "Eleve") {

            $projects = Auth::user()->projects()->get();

            return view('student', ['projects' => $projects]);

        }
        // If the user has a role like "Prof", he can access teacher view ans he can see all projects
        elseif(Auth::user()->role->name == "Prof"){

            $projects = Project::all();

            return view('teacher', ['projects' => $projects]);
        }
    }

    // Display all informations like the user's tasks connected, all project tasks, and so on
    public function show($id)
    {
        $project = Project::find($id);
        $currentUser = Auth::user();
        $userTasks = UsersTask::where("user_id", "=", $currentUser->id)->get();
        $duration = null;
        $task = null;
        $request="";
        foreach ($userTasks as $userstask) {
            foreach ($userstask->durationsTasks()->get() as $durationtask) {
                if ($durationtask->ended_at == null) {
                    $duration = $durationtask->id;
                    $task = $userstask->task_id;
                }
            }
        }

        /* Created By Fabio Marques
          Description: create a new CheckListObject
        */
        $livrables = new CheckList('Project', $id, 'Livrables');


        /* Created By Raphaël B.
          Description: log book event handling
        */
        $events = Event::where('project_id', '=', $id)
            ->orderBy('created_at', 'desc')->get();

        $projectMembers = $project->users->sortBy('id');

        $badgeCount = 0;

        // Array containing lists of users that have validated events
        $validations = array();

        foreach ($events as $event) {
            // Holds ids of users that have validated the event
            $users = array();
            foreach ($projectMembers as $member) {
                $exists = EventsUser::where([
                    ['user_id', '=', $member->id],
                    ['event_id', '=', $event->id],
                ])->exists();

                if($exists) {
                    $users[] = $member->id;
                }
            }

            $validations[$event->id] = $users;

            // Incrementing badgeCount unless the current user validated the event
            if (!in_array($currentUser->id, $users)) {
                $badgeCount++;
            }
        }

        return view('project/show', [
            'project' => $project,
            'livrables'=>$livrables,
            'duration' => $duration,
            'taskactive' => $task,
            'currentUser' => $currentUser,
            'members' => $projectMembers,
            'events' => $events,
            'validations' => $validations,
            'badgeCount' => $badgeCount
        ]);
    }

    // Return the view about files -> not yet made
    public function files()
    {
        return view('project/show');
    }

    // Return the view to editing projects
    public function edit()
    {
        return view('project/edit');
    }

    // Return the view about tasks
    public function task()
    {
        return view('project/task');
    }

    // Return the view to creating projects
    public function create()
    {
        return view('project/edition/create');
    }

    // Create a task
    public function store(Request $request)
    {
        $newProject = new Project;
        $relation = new ProjectsUser;
        $newProject->name = $request->input('name');
        $newProject->description = $request->input('description');
        $newProject->startDate = $request->input('date');
        $newProject->save();

        $relation->project_id = $newProject->id;
        $relation->user_id = Auth::user()->id;
        $relation->save();

        /*
          Created By: Fabio Marques
          Decription: create a new checkList for the new project
        */
        CheckList::newCheckList('Project',$newProject->id,'Livrables');

        return redirect()->route('project.index');
    }

    // Return te view to creating tasks
    public function createTask($id)
    {
        return view('task.create', ['project' => $id]);
    }

    // Edit a task
    public function storeTask(Request $request)
    {

        $project_id = $request->input('project_id');

        $newTask = new Task;
        $newTask->name = $request->input('name');
        $newTask->duration = $request->input('duration');
        $newTask->date_jalon = $request->input('date_jalon');
        $newTask->project_id = $project_id;
        $newTask->parent_id = NULL;
        $newTask->save();

        // Adding the event description into the request object
        $eventDescription = "Création d'une tâche parent";
        $request->merge([ 'description' => $eventDescription ]);

        (new EventController())->store($project_id, $request); // Create an event

        return redirect("project/" . $request->input('project_id'));
    }

    // Delete one or more users for a project
    public function destroyUser(Request $request){
        $destroyUser = ProjectsUser::where("project_id", "=", $request->id)->where("user_id", "=", $request->user)->get();
        $destroyUser->delete();
    }

    // Create a target
    public function storeTarget(Request $request, $id){

        $target = new Target;
        $target->description = $request->input('description');
        $target->project_id = $id;
        $target->status = "Wait";
        $target->save();

        return redirect("project/" . $id);
    }

   // Validate a target
    public function valideTarget(Request $request, Target $target){

        $target->update([
            'status' => "Finished"
        ]);

    }

    // Return the target view
    public function getTarget(Request $request, $id){
        return view('target.store', ['project' => $id]);
    }

    public function createCheckListItem( $checkListId)
    {
      return view('checkList.create', ['checkListId'=>$checkListId]);//view('checkList.create', ['checkListId' => $id]);
    }

    /*public function getTask(Request $request){

        if($request->ajax())
        {
            return 'getRequest has loaded comple';
        }

        $task = Task::find($request['task']);
        return view('project/taskdetail', ['task' => $task]);

        if(Request::ajax()){
            return Response::json(Request::all());
        }
    }*/

}
