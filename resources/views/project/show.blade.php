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

        <div class="row">
            <div class="col-md-6">
                <h1>Vos tâches</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display the tasks connected user -->
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
                    <div>
                        <label><input type="checkbox" value="first_checkbox" id="toggleUserEntries">Avec mes entrées</label>
                    </div>
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
                                            <button type="button" id="validationButton" class="btn btn-primary clickable" style="margin-left: 20px;" data-userId="{{$currentUser->id}}">Valider</button>
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
