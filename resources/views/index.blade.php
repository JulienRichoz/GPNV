@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <!-- Display all projects for the user connected -->
        @foreach($projects as $project)
        <div class="col-xs-12 col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2><a href="{{route('project.index')}}/{{ $project->id }}">{{ $project->name }}</a></h2>
            </div><!-- Display the project name -->
            <div class="panel-body">
              <div class="infos">
                <h5>Début du projet : {{ $project->startDate }}</h5>
              </div>
              <h4 data-toggle="collapse" data-target="#users_{{ $project->id }}" class="showMembres"><span class="glyphicon glyphicon-chevron-down btn"></span>Membres : </h4>
              <!-- Display all project members -->
              <div id="users_{{ $project->id }}" class="collapse">
                @foreach($project->users as $user)
                    @include('user.avatar', ['user' => $user])
                @endforeach
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <a class="btn btn-default" href="{{route('project.create')}}">Créer votre projet !</a>
    </div>
@endsection
