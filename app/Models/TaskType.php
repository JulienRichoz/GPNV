<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Role;
use DB;

class TaskType extends Model
{

  protected $table = 'taskTypes';
  protected $fillable = ['id', 'name', 'updated_at'];

  public function getTask(){
    return $this->hasMany(\App\Models\Task::class, 'type_id', 'id');
  }

}
