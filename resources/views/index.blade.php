@extends('layouts.app')

@section('content')
    <div class="container">
            <a href="#top"></a>
            <!-- Display all projects for the user connected -->
            @foreach($projects as $project)

            <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 style="display:inline;"><a href="{{route('project.index')}}/{{ $project->id }}">{{ $project->name }}</a></h2>
                  <div class="infos" style="float:right;">
                    <h5>Date de début du projet : {{ $project->startDate }}</h5>
                  </div>
                </div><!-- Display the project name -->
                <div class="panel-body">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" data-toggle="collapse" aria-expanded="false" data-target=".users{{ $project->id }}"></span>
                    <h4 style="display: inline-flex;">Membres : </h4>
                    <!-- Display all project members -->
                    <div class="users{{ $project->id }} collapse">
                      @foreach($project->users as $user)
                          @include('user.avatar', ['user' => $user])
                      @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        <a class="button btn btn-default" href="{{route('project.create')}}">Créer votre projet !</a>
        <a class="button btn btn-default scrollTop" href="#top" style="float:right;">
          <span class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="font-size: 30px; left: -3.5px;"></span>
        </a>
    </div>
@endsection
