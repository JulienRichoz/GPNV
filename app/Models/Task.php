<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\CheckList;

class Task extends Model
{

    /**
     * Generated
     */

    protected $table = 'tasks';
    protected $fillable = ['id', 'name', 'duration', 'status_id', 'priority', 'objective_id', 'project_id', 'parent_id', 'created_at', 'type_id'];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function getUser(){
        return $this->hasManyThrough('App\Models\User','App\Models\UsersTask', 'task_id','id');
    }

    public function usersTasks()
    {
        return $this->hasMany(\App\Models\UsersTask::class, 'task_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Task::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(\App\Models\Task::class, 'parent_id');
    }

    public function allChildren()
    {
      return $this->children()->with('allChildren');
    }

    public function getObjective(){
      return DB::table('checkList_Items')->where('id', $this->objective_id)->first();
    }

    public function getTaskType(){
      if($this->type_id!=null)
        return DB::table('taskTypes')->where('id', $this->type_id)->first();
      else
        return null;
    }

    // Check if task have children of multiple types
    public function isChildrenDifferentTypes(){
      if($this->children->isEmpty())
        return false;
      else{
        $taskTypes = array_unique(DB::table('tasks')->where('parent_id', $this->id)->pluck('type_id'));
        if(count($taskTypes)!=1) return true;
        else return false;
      }
    }

    //modified By :Fabio Marques
    public function getElapsedDuration()
    {
        $total = 0;

        if(!$this->children->isEmpty())
        {
          foreach ($this->children as $child) {
              $total += $child->getElapsedDuration();
          }
        }
        else {
          foreach ($this->usersTasks as $usertask) {
              foreach ($usertask->durationsTasks as $durationTask) {
                  if ($durationTask->ended_at) {
                      $total += strtotime($durationTask->ended_at) - strtotime($durationTask->created_at);
                  }
              }
          }
        }


        return $total;
    }

    // Modified By: Fabio Marques
    public function getDurationTask(){

        $total = 0;

        if(!$this->children->isEmpty())
        {
          foreach ($this->children as $child){
              $total += $child->getDurationTask();
          }
        }
        else
          $total += $this->duration;

        return $total;
    }

    public function ifChildTaskNoValidate($isFirst = true){
        if(!$isFirst && $this->status != "validate") return false;
        $children_activated = true;
        foreach ($this->children as $child) {
            if (!$child->ifChildTaskNoValidate(false)) {
                $children_activated = false;
            }
        }
        return $children_activated;
    }


    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'task_id');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status');
    }

    // he task if like the entry of the input q with a value before or after
    // do a second where, to do the search for the project and not another
    public static function scopeSearchInAvailableProperty($query, $q, $id)
    {
        return $query->where('name', 'like', "%{$q}%")->where('project_id', '=', "{$id}");
    }
}
