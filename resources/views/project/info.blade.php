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
                <!-- <button class="right btn userprojectdestroy" data-id="{{$user->id}}" data-projectid="{{$project->id}}">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button> -->
            </p>
        @endforeach

        <a class="btn btn-warning addStudents" data-projectid="{{$project->id}}">Ajouter un élève</a>
        <a class="btn btn-warning addTeachers" data-projectid="{{$project->id}}">Ajouter un enseignant</a>
        <a class="btn btn-warning quitProject" data-projectid="{{$project->id}}" style="float: right;">Quitter le projet</a>

    </div>

    <div class="panel-heading">Objectifs du projet</div>

    <div class="panel-body">
        <br>
        <a class="btn btn-warning target" data-projectid="{{$project->id}}">Ajouter un objectif</a>
    </div>


</div>
