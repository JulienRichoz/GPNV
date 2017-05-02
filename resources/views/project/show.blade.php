@extends('layouts.app')

@section('content')
<div class="container">
    <a href="#top"></a>
    <h1 style="text-align: center; margin-bottom: 40px;">{{$project->name}}</h1>

    @include('project.infos')

    @include('project.objective', ['objectifs' => $objectifs])

    @include('project.membership')

    <div class="panel panel-default">
        <!-- Display all project informations like the members, a description and so on -->
        <div class="panel-heading" id="taskBanner taskHeading" data-toggle="collapse" data-target=".projectTasks">
          <div class="trigger" aria-expanded="false">
              <h1>Les t&acirc;ches</h1>
              <span class="glyphicon glyphicon-chevron-up disclosureIndicator"/>
          </div>
        </div>
        <div class="panel-body projectTasks collapse" data-projectid="{{$project->id}}">
          <div class="col-md-12">
            <div id="filters">
                <div class="awesomeCheckbox awesomeCheckbox-primary filterCheckboxes">
                    <input data-status="wip" type="checkbox" checked="checked" id="checkWip" class="styled checkboxFilter">
                    <label for="checkWip" class="checkboxFilterLabel">
                        En cours
                    </label>

                    <input data-status="todo" type="checkbox" id="checkTodo" class="styled checkboxFilter">
                    <label for="checkTodo" class="checkboxFilterLabel">
                        A faire
                    </label>

                    <input data-status="done" type="checkbox" id="checkDone" class="styled checkboxFilter">
                    <label for="checkDone" class="checkboxFilterLabel">
                        Terminée
                    </label>
                </div>

                <div class="dropdown dropTaskFilter">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span id="dropdownTitleOwner">Tous</span>
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu owner" aria-labelledby="dropdownMenu" >
                        <li><a data-taskOwner="all" class="activeOwner">Tous</a></li>
                        <li><a data-taskOwner="{{$currentUser->id}}">Moi</a></li>
                        <li><a data-taskOwner="nobody">Personne</a></li>
                        <li role="separator" class="divider"></li>
                        {{-- Displaying project members --}}
                        @foreach($members as $member)
                            {{-- Making sure not to display the current user --}}
                            @unless($member->id == $currentUser->id)
                                <li><a data-taskOwner="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</a></li>
                            @endunless
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown dropTaskFilter">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span id="dropdownTitleObjective">Tous les objectifs</span>
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu objective" aria-labelledby="dropdownMenu" >
                        <li><a data-objective="all" class="activeOwner">Tous les objectifs</a></li>
                        @if($objectifs->showToDo())
                          @foreach($objectifs->showToDo() as $checkListItem)
                            <li><a data-objective="{{$checkListItem->id}}">{{$checkListItem->title}}</a></li>
                          @endforeach
                        @endif
                    </ul>
                </div>
            </div>
          <hr/>
          </div>

          <div id="taskList" class="col-md-6">
              <div class="tree-menu" id="tree-menu">
                  <ul>
                  <!-- project tasks are displayed from refreshDisplayedTasks() in checkList.js -->
                  </ul>
              </div>
              @if(Auth::user()->projects()->find($project->id))
                  <a class="btn btn-warning taskroot" data-id="{{$project->id}}">Créer une tâche racine</a>
              @endif
          </div>
          <div class="col-md-6"><h1>Détails de la tâche</h1>
              <div id="taskdetail"></div>
          </div>
        </div>
    </div>

    @include('project.logbook')

    @include('project.delivery')

    @include('project.file')

    <a class="button btn btn-default scrollTop" href="#top" style="float:right;">
      <span class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="font-size: 30px; left: -3.5px;"></span>
    </a>

@endsection
