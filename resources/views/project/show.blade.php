@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Votre planning</div>
            <div class="panel-body">
{{--                @include('planning.show', ['taskparent' => $project->tasksParent])--}}
            </div>
        </div>

        <div>
            <form id="search" method="POST" action="{{ route('search.store', $project->id) }}">
                {!! csrf_field() !!}
                <input name="search" type="text" placeholder="Mots-Clefs..."/>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Chercher
                </button>

            </form>
        </div>

        <div id="taskBanner">
            <h1 data-toggle="collapse" data-target=".projectTasks" aria-expanded="false">Les t&acirc;ches du projet</h1>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    En cours
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    A faire
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    Termin&eacute;e
                </label>
            </div>

            <div class="dropdown dropTaskFilter">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                t&acirc;ches de...
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">Tous</a></li>
                    <li><a href="#">Moi</a></li>
                    <li><a href="#">Personne</a></li>
                    <li role="separator" class="divider"></li>
                    @foreach($members as $member)
                        <li><a href="#">{{$member->firstname}} {{$member->lastname}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row collapse projectTasks">
            <div class="col-md-6">
                <h1>Vos tâches</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display the connected user tasks -->
                        @foreach($project->tasksParent as $task)
                            @include('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration])
                        @endforeach
                    </ul>
                </div>
                <h1>Les tâches du projet</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display all project tasks -->
                        @each('project.task', $project->tasksParent, 'task')
                    </ul>
                </div>
                <a class="btn btn-warning taskroot" data-id="{{$project->id}}">Créer une tâche racine</a>



            </div>
            <div class="col-md-6"><h1>Détails de la tâche</h1>
                <div id="taskdetail"></div>
            </div>
        </div>

        <!--*********************** partie PRW2***********************
        Created By: Fabio Marques
        Description: Show the checkList "Livrables"
        -->
        <h1>{{$livrables->getName()}}</h1>
        <div class="livrables">
            <div class="progressionLivrable">
                <div class="barre" style="background: linear-gradient(90deg, #20DE13 {{$livrables->getCompletedPercent()}}%, #efefef 0%);"></div>
                <p>{{$livrables->getNbItemsDone()}}/{{$livrables->getNbItems()}}</p>
            </div>
            <ul>
            <!-- Display all livrables -->
            @if($livrables->showToDo())
              @each('checkList.show', $livrables->showToDo(), 'checkListItem')
            @endif
            </ul>
            <ul class="completed hidden">
                @if($livrables->showCompleted())
                @each('checkList.show', $livrables->showCompleted(), 'checkListItem')
                @endif
            </ul>
            <a class="btn btn-warning addCheckList" data-id="{{$livrables->getId()}}" data-URL="{{ URL('project') }}">Ajouter</a>
            @if($livrables->getNbItemsDone())
                <a class="btn btn-warning changeView">Voir les éléments effectués</a>
                <a class="btn btn-warning changeView hidden">Cacher les éléments effectués</a>
            @endif
        </div>

        <!--******************************************************** -->

        <h1>Informations du projet</h1>
        <!-- Display all project informations like the members, a description and so on -->
        @include('project.info', ['student' => $project])

        <!-- Custom journal -->
        <div id="accordion">
            <div id="logBookContainer" data-projectId="{{$project->id}}">
                <h1 id="logBookHeading" data-toggle="collapse" data-target="#logBook" aria-expanded="false" style="cursor: pointer">
                    @unless ($badgeCount == 0)
                        <span id="logBookBadge" class="badge">{{$badgeCount}}</span>
                    @endunless
                    Journal de bord
                </h1>
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
            </div>
        </div>
        <!-- End of custom journal -->

        <h1>Fichiers</h1>
        <div class="panel panel-default" id="files">
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
    </div>

@endsection
