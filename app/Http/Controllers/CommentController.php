<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class CommentController extends Controller
{
    /**
    * Return the view comments
    * @param $comment The comment item
    * @return view to see comments
    */
    function show(Comment $comment){
        return view('comment.show', ['comment' => $comment]);
    }

    /**
    * Create a new comment for a task
    * @param $request Define the request data send by POST
    * @return view to project
    */
    function store(Request $request, Task $task){
        $newComment = new Comment;
        $newComment->comment = $request->input('comment');
        $newComment->user_id = Auth::user()->id;
        $newComment->task_id = $request->task->id;
        $newComment->save();

        return redirect()->route("project.show", ['id'=>$request->task->project_id]);
    }
}
