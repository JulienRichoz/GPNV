<div class="trigger well well-sm" data-toggle="collapse" data-target=".objectives" aria-expanded="false">
    <h1>Objectifs</h1>
    <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
</div>

<div class="objectives collapse" data-projectid="{{$project->id}}">
    <!-- Display all project informations like the members, a description and so on -->
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="progressionCheckList">
          <div class="barre" style="background: linear-gradient(90deg, #20DE13 {{$objectifs->getCompletedPercent()}}%, #efefef 0%);"></div>
          <p>{{$objectifs->getNbItemsDone()}}/{{$objectifs->getNbItems()}}</p>
        </div>
        <ul>
            <!-- Display all yourCheckList -->
            @if($objectifs->showToDo())
              @foreach($objectifs->showToDo() as $checkListItem)
                @include('checkList.show', array('checkListItem'=>$checkListItem, 'modalBox' => true, 'projectId'=>$project->id))
              @endforeach
            @endif
        </ul>
        <ul class="completed hidden">
          @if($objectifs->showCompleted())
            @foreach($objectifs->showCompleted() as $checkListItem)
              @include('checkList.show', array('checkListItem'=>$checkListItem, 'modalBox' => true, 'projectId'=>$project->id))
            @endforeach
          @endif
        </ul>
        <a class="btn btn-warning addCheckList" data-id="{{$objectifs->getId()}}" data-projectid="{{$project->id}}" data-URL="{{ URL('project') }}">Ajouter</a>
        @if($objectifs->getNbItemsDone())
          <a class="btn btn-warning changeView">Voir les objectifs validés</a>
          <a class="btn btn-warning changeView hidden">Cacher les objectifs validés</a>
        @endif
      </div>
    </div>
</div>
