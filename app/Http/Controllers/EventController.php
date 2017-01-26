<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ProjectsUser;
use App\Models\EventsUser;
use App\Models\UsersTask;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Models\Event;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;
use DB;

class EventController extends Controller
{
    // Display all project events
    public function show(Project $project, Request $request)
    {
        $currentUserId = Auth::id();

        $eventInfos = DB::table('events')
            ->join('projects', 'projects.id', '=', 'events.project_id')
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('events.id as eventId', 'users.id as userId', 'users.firstname', 'users.lastname', 'events.description', 'events.created_at')
            ->where('events.project_id', '=', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $projectMembers = Project::find($request->id)->users->sortBy('id');

        // Array containing lists of users that have validated events
        $validations = array();

        foreach ($eventInfos as $eventKey => $event) {
            // Holds ids of users that have validated the event
            $users = array();
            foreach ($projectMembers as $member) {
                $exists = EventsUser::where([
                    ['user_id', '=', $member->id],
                    ['event_id', '=', $event->eventId],
                ])->exists();

                if($exists) {
                    $users[] = $member->id;
                }
            }
            $validations[$event->eventId] = $users;
        }

        $unValidated = DB::table('events_users')
            ->select('event_id')
            ->distinct()
            ->get();

        // Events validated by the current user
        $validated = DB::table('events_users')
            ->select('event_id')
            ->distinct()
            ->where('user_id', '=', $currentUserId)
            ->get();

        $unValidatedCount = count($unValidated);
        $validatedCount = count($validated);

        $badgeCount = $unValidatedCount - $validatedCount;

        return json_encode(array(
            'eventInfos'=>$eventInfos, 
            'currentUser'=>['id'=>$currentUserId], 
            'validations' => $validations,
            'members' => $projectMembers,
            'badgeCount' => $badgeCount
        ));
    }

    // Create an event
    public function store($project, Request $request)
    {
        $event = new Event;
        $event->user_id = Auth::user()->id;
        $event->project_id = $project;
        $event->description = $request->description;
        $event->save();

        // relationship management
        $relation = new EventsUser;
        $relation->event_id = $event->id;
        $relation->user_id = Auth::user()->id;
        $relation->save();
    }

    public function storeValidation($project, Request $request) {
        $relation = new EventsUser;
        $relation->event_id = $request->eventId;
        $relation->user_id = $request->userId;
        $relation->save();

        return json_encode($relation);
    }

    // Return view event form
    public function formEvent($id)
    {
        return view('events.store', ['id' => $id]);
    }
}
