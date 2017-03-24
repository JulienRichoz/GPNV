@extends('layouts.app')

@section('content')
<div class="container">
    <a href="#top"></a>
    <h1 style="text-align: center; margin-bottom: 40px;">{{$project->name}}</h1>

    @include('project.infos')

    @include('project.objective', ['objectifs' => $objectifs])

    @include('project.membership')

    <div id="taskBanner" data-projectid="{{$project->id}}">
        <div class="trigger well well-sm">
            <h1 id ="taskHeading" data-toggle="collapse" data-target=".projectTasks" aria-expanded="false">Les t&acirc;ches</h1>
            <div id="filters" class="hidden">
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
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span id="dropdownTitle">tous</span>
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" >
                        <li><a href="#" data-taskOwner="all" class="activeOwner">Tous</a></li>
                        <li><a href="#" data-taskOwner="{{$currentUser->id}}">Moi</a></li>
                        <li><a href="#" data-taskOwner="nobody">Personne</a></li>
                        <li role="separator" class="divider"></li>
                        {{-- Displaying project members --}}
                        @foreach($members as $member)
                            {{-- Making sure not to display the current user --}}
                            @unless($member->id == $currentUser->id)
                                <li><a href="#" data-taskOwner="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</a></li>
                            @endunless
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- end of taskBanner -->

    <div class="row collapse projectTasks">
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

    <!-- Custom journal -->
    <div class="trigger well well-sm">
        <h1 id="logBookHeading" data-toggle="collapse" data-target="#logBook" aria-expanded="false">
            @unless ($badgeCount == 0)
                <span id="logBookBadge" class="badge">{{$badgeCount}}</span>
            @endunless
            Journal de bord
        </h1>
        <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
    </div>

    @include('project.logbook')

    @include('project.delivery')

    @include('project.file')

    <a class="button btn btn-default scrollTop" href="#top" style="float:right;">
      <span class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="font-size: 30px; left: -3.5px;"></span>
    </a>

@endsection
