<li>
  <a href="#" ><span class="taskshow" data-id="{{$task->id}}"><p> {{$task->name}}</p></span>
    @if($task->children->isEmpty())
      <button class="right btn taskuser" data-id="{{$task->id}}"> <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span> </button>
      <button class="right btn taskdestroy"  data-id="{{$task->id}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
    @endif
    <button class="right btn taskedit" data-id="{{$task->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </button>
    <button class="right btn taskplus" data-id="{{$task->id}}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
  </a>
  <div class="progression" style="background: linear-gradient(90deg, #20DE13 {{(($task->getElapsedDuration()*100/60/60)/$task->duration)}}%, #efefef 0%);">
    <p style="text-align: left;">{{gmdate("H:i:s",$task->getElapsedDuration())}}</p>
    <p> | {{round(($task->getElapsedDuration()*100/60/60)/$task->getDurationTask(),1)}}%</p><!-- Display the task pourcent -->
    <p style="text-align: right;margin-left: auto;">{{$task->getDurationTask()}}h</p>
  </div>

  @unless($task->children->isEmpty())
    <ul>
      @each('project.task', $task->children, 'task')<!-- Display task children -->
    </ul>
  @endunless

</li>
