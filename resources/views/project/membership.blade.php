<div class="trigger well well-sm" data-toggle="collapse" data-target=".membership" aria-expanded="false">
    <h1>Membres</h1>
    <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
</div>

<div class="membership collapse" data-projectid="{{$project->id}}">
    <!-- Display all project informations like the members, a description and so on -->

    <div class="panel panel-default">
      <div class="panel-body members">
          @foreach($project->users as $user)
              <p>
                  <!-- Display all project members -->
                  @include('user.avatar', ['user' => $user, 'inProject' => true])
              </p>
          @endforeach

          <div class="row">
            <div class="col-md-12">
              @if(Auth::user()->projects()->find($project->id))
                <a class="btn btn-warning addStudents" data-projectid="{{$project->id}}">Ajouter un élève</a>
                <a class="btn btn-warning addTeachers" data-projectid="{{$project->id}}">Ajouter un enseignant</a>
                <a class="btn btn-warning quitProject" data-projectid="{{$project->id}}" data-id="{{Auth::user()->id}}" style="float: right;">Quitter le projet</a>
              @endif
            </div>
          </div>

      </div>
    </div>

</div>
