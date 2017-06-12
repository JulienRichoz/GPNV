<div class="col-xs-12 col-lg-6" id="data-tasktypes">
  <h4>Types de tâches disponible :</h4>
  @foreach(App\Models\TaskType::all() as $taskType)
  <div class="well well-sm">
    <div class="media">
        <div class="media-body">
          <label>{{$taskType->name}}</label>
        </div>
    </div>
  </div>
  @endforeach
</div>
