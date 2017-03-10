<div class="panel panel-default">
    <div class="panel-heading">Informations</div>

    <div class="panel-body">
        <!-- Display the information about project -->
        <p>Nom : {{$project->name}}</p>
        <p>Date de début : {{$project->startDate}}</p>
        <p>Description : {{$project->description}}</p>
    </div>

    <div class="panel-heading">Membres du projet</div>

    <div class="panel-body">
        @foreach($project->users as $user)
            <p>
                <!-- Display all project members -->
                @include('user.avatar', ['user' => $user])
                <button class="right btn userprojectdestroy" data-id="{{$user->id}}" data-projectid="{{$project->id}}">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </p>
        @endforeach
        <a class="btn btn-warning invitation" data-projectid="{{$project->id}}">Ajouter une personne</a>
        <a class="btn btn-warning invitationwait" data-projectid="{{$project->id}}">Voir les invitations en attente</a>

    </div>

    <div class="panel-heading">{{$objectifs->getName()}}</div>

    <div class="panel-body">
      <div class="checkList">
        <div class="progressionCheckList">
          <div class="barre" style="background: linear-gradient(90deg, #20DE13 {{$objectifs->getCompletedPercent()}}%, #efefef 0%);"></div>
          <p>{{$objectifs->getNbItemsDone()}}/{{$objectifs->getNbItems()}}</p>
        </div>
          <ul>
              <!-- Display all yourCheckList -->
              @if($objectifs->showToDo())
                @foreach($objectifs->showToDo() as $checkListItem)
                  @include('checkList.show', array('checkListItem'=>$checkListItem, 'modalBox' => true))
                @endforeach
              @endif
          </ul>
          <ul class="completed hidden">
            @if($objectifs->showCompleted())
              @foreach($objectifs->showCompleted() as $checkListItem)
                @include('checkList.show', array('checkListItem'=>$checkListItem, 'modalBox' => true))
              @endforeach
            @endif
          </ul>
          <a class="btn btn-warning addCheckList" data-id="{{$objectifs->getId()}}" data-URL="{{ URL('project') }}">Ajouter</a>
          @if($objectifs->getNbItemsDone())
            <a class="btn btn-warning changeView">Voir les objectifs validés</a>
            <a class="btn btn-warning changeView hidden">Cacher les objectifs validés</a>
          @endif
      </div>
    </div>


</div>
