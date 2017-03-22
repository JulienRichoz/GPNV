@extends('layouts.app')

@section('content')
<div class="container">

    <h1 style="text-align: center; margin-bottom: 40px;">{{$project->name}}</h1>

    <!-- <div class="panel panel-default">
        <div class="panel-heading">Votre planning</div>
        <div class="panel-body">
            {{--@include('planning.show', ['taskparent' => $project->tasksParent])--}}
        </div>
    </div> -->

    <!-- <div>
        <form id="search" method="POST" action="{{ route('search.store', $project->id) }}">
            {!! csrf_field() !!}
            <input name="search" type="text" placeholder="Mots-Clefs..."/>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Chercher
            </button>
        </form>
    </div> -->

    <div id="taskBanner" data-projectid="{{$project->id}}">
        <div class="trigger well well-sm">
            <h1 id ="taskHeading" data-toggle="collapse" data-target=".projectTasks" aria-expanded="false">Les t&acirc;ches du projet</h1>
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

    <!--*********************** partie PRW2***********************
    Created By: Fabio Marques
    Description: Show the checkList "Livrables"
    -->
    <div class="trigger well well-sm" data-toggle="collapse" data-target=".deliverables" aria-expanded="false">
        <h1>{{$livrables->getName()}}</h1>
        <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
    </div>
    
    <div class="deliverables collapse">
        <div class="checkList">
            <div class="progressionCheckList">
                <div class="barre" style="background: linear-gradient(90deg, #20DE13 {{$livrables->getCompletedPercent()}}%, #efefef 0%);"></div>
                <p>{{$livrables->getNbItemsDone()}}/{{$livrables->getNbItems()}}</p>
            </div>
            <ul>
                <!-- Display all livrables -->
                @if($livrables->showToDo())
                    @foreach($livrables->showToDo() as $checkListItem)
                        @include('checkList.show', array('checkListItem'=>$checkListItem, 'projectId'=>$project->id))
                    @endforeach
                @endif
            </ul>
            <ul class="completed hidden">
                @if($livrables->showCompleted())
                    @foreach($livrables->showCompleted() as $checkListItem)
                        @include('checkList.show', array('checkListItem'=>$checkListItem, 'projectId'=>$project->id))
                    @endforeach
                @endif
            </ul>
            @if(Auth::user()->projects()->find($project->id))
                <a class="btn btn-warning addCheckList" data-id="{{$livrables->getId()}}" data-projectid="{{$project->id}}" data-URL="{{ URL('project') }}">Ajouter</a>
            @endif
            @if($livrables->getNbItemsDone())
                <a class="btn btn-warning changeView">Voir les éléments effectués</a>
                <a class="btn btn-warning changeView hidden">Cacher les éléments effectués</a>
            @endif
        </div>
    </div>


    <!--******************************************************** -->
    
    <div class="trigger well well-sm" data-toggle="collapse" data-target=".projectInfo" aria-expanded="false">
        <h1>Informations du projet</h1>
        <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
    </div>

    <div class="projectInfo collapse">
        <!-- Display all project informations like the members, a description and so on -->
        @include('project.info', ['student' => $project, 'objectifs' => $objectifs])
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

    <div id="logBookContainer" data-projectId="{{$project->id}}">
    <div id="logBook" class="collapse">
    <form role="form">
        <div class="awesomeCheckbox awesomeCheckbox-primary logBookCheckbox">
        <input type="checkbox" id="toggleUserEntries" class="styled">
            <label for="toggleUserEntries">
                Avec mes entrées
            </label>
        </div>
    </form>

    <div class="panel panel-default" id="logbookPanel">
        <table class='table'>
            <thead><tr><th>Qui</th><th>Quand</th><th>Quoi</th><th>Vu</th></tr></thead>
            @foreach($events as $event)
                {{-- Checking if the current user is the event creator --}}
                @if($currentUser->id == $event->user_id)
                    <tr class="userMade hidden" data-eventId="{{$event->id}}">
                @else
                    <tr data-eventId="{{$event->id}}">
                @endif
                <td>{{$event->users->find($event->user_id)->firstname}} {{$event->users->find($event->user_id)->lastname}}</td>
                <td>{{date('d.m.y H:i', strtotime($event->created_at))}}</td>
                <td>{{$event->description}}</td>
                <td>
                    {{-- Member event validation handling --}}
                    @foreach($members as $member)
                        @unless($member->id == $currentUser->id)
                            <span title="{{ $member->firstname }} {{ $member->lastname }}" data-toggle="tooltip" data-placement="bottom">
                                {{-- Checking if the member has validated this event --}}
                                @if(in_array($member->id, $validations[$event->id]))
                                    <span class="glyphicon glyphicon-stop validEvent" aria-hidden="true" data-userId="{{$member->id}}"></span>
                                @else
                                    <span class="glyphicon glyphicon-stop invalidEvent" aria-hidden="true" data-userId="{{$member->id}}"></span>
                                @endif
                            </span>
                        @endunless
                    @endforeach

                    @unless(in_array($currentUser->id, $validations[$event->id]))
                        <button type="button" class="btn btn-primary validationButton" style="margin-left: 20px;" data-userId="{{$currentUser->id}}">Valider</button>
                    @endunless
                </td>
                    </tr>
            @endforeach
        </table>
        </div>
        <a class="btn btn-warning events" data-id="{{$project->id}}">Ajouter un événement</a>
        </div>
    </div><!-- End of logbook -->

    <div class="trigger well well-sm" data-toggle="collapse" data-target=".filesInfo" aria-expanded="false">
        <h1>Fichiers</h1>
        <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
    </div>

    <div class="filesInfo collapse">
        <div class="panel panel-default" id="files">
            @if(Auth::user()->projects()->find($project->id))
                <div class="panel-heading">Ajoutez des fichiers</div>
                <div class="panel-body">
                    <div class="container">
                    <form enctype="multipart/form-data" action="{{route('files.store', $project->id)}}" method="post">
                        {!! csrf_field() !!}

                        <label class="col-md-4 control-label">Description du fichier</label>

                        <div class="col-md-6">
                            <input type="texte" class="form-control" name="description" value="" required>
                        </div>

                        <label class="col-md-4 control-label">Le fichier</label>

                        <div class="col-md-6">
                            <input type="file" name="file">
                        </div>

                        <div class="col-md-6">
                            <input type="submit" value="Envoyer">
                        </div>

                        </form>
                    </div>
                </div>
            @endif

            <div class="panel-heading">Fichiers du projet</div>
            <div class="panel-body">
                <div class="container">
                    @foreach($project->files as $file)
                        <div class="file">
                            <a href="{{asset('files/'.$project->id.'/'.$file->url)}}" download="{{$file->name}}">
                            <img class="" src="{{asset('images/icon/'.$file->mime.'.png')}}">
                            <p>{{$file->name}}</p>
                            <p>{{$file->description}}</p>
                            <p>{{round($file->size / (1024*1024), 2)}} MB</p>
                            </a>
                            <button class="right btn filedestroy" data-project="{{$project->id}}"
                            data-id="{{$file->id}}">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <a class="button btn btn-default scrollTop" href="#top" style="float:right;">
          <span class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="font-size: 30px; left: -3.5px;"></span>
        </a>
    </div>

@endsection
