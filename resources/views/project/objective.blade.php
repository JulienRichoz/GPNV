<div class="col-xs-12 col-lg-6">
  <div class="panel panel-default">
    <!-- Display all project informations like the members, a description and so on -->
    <div class="panel-heading showPanel" data-toggle="collapse" data-target="#objectives">
      <h1 >Objectifs <span class="glyphicon glyphicon-chevron-down pull-right"></span></h1>
    </div>
    <div id="objectives" class="panel-body objectives collapse" data-projectid="{{$project->id}}">
      <div class="objectivesData">
        <div class="progressionCheckList">
          <div class="barre" style="background: linear-gradient(90deg, #20DE13 {{$objectifs->getCompletedPercent()}}%, #efefef 0%);"></div>
          <p>{{$objectifs->getNbItemsDone()}}/{{$objectifs->getNbItems()}}</p>
        </div>
        <div>
            <!-- Display all yourCheckList -->
            @if($objectifs->showToDo())
              @foreach($objectifs->showToDo() as $checkListItem)
                @unless($checkListItem->title == "Intérêt Général")
                  @include('checkList.show', array('checkListItem'=>$checkListItem, 'modalBox' => true, 'projectId'=>$project->id))
                @endunless
              @endforeach
            @endif
        </div>
        <div class="completed hidden">
          @if($objectifs->showCompleted())
            @foreach($objectifs->showCompleted() as $checkListItem)
              @unless($checkListItem->title == "Intérêt Général")
                @include('checkList.show', array('checkListItem'=>$checkListItem, 'modalBox' => true, 'projectId'=>$project->id))
              @endunless
            @endforeach
          @endif
        </div>
      </div>
      @if(Auth::user()->projects()->find($project->id))
        <a class="btn btn-primary addCheckList" data-id="{{$objectifs->getId()}}" data-projectid="{{$project->id}}" data-URL="{{ URL('project') }}">Ajouter</a>
      @endif
      @if($objectifs->getNbItemsDone())
        <a class="btn btn-primary changeView">Voir les objectifs validés</a>
        <a class="btn btn-primary changeView hidden">Cacher les objectifs validés</a>
      @endif
      <button class="btn btn-primary reloadobjectives pull-right" data-projectid="{{$project->id}}">
        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</div>
