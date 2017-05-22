<div class="col-xs-12 col-lg-6">
  <div class="panel panel-default">

    <div class="panel-heading showPanel" data-toggle="collapse" data-target="#membership">
      <h1>Membres <span class="glyphicon glyphicon-chevron-down pull-right"></span></h1>
    </div>

    <div id="membership" class="panel-body members membership collapse" data-projectid="{{$project->id}}">
        <?php $Mails="";?>
        <div class="membershipsData">
          @foreach($project->users as $user)
              <?php $Mails.=$user->mail.';';?>
              @include('user.avatar', ['user' => $user, 'inProject' => true, 'projectName' => $project->name])
          @endforeach
        </div>

        <div class="row">
          <div class="col-md-12">
            @if(Auth::user()->projects()->find($project->id))
              <a class="btn btn-primary addStudents" data-projectid="{{$project->id}}">Ajouter un élève</a>
              <a class="btn btn-primary addTeachers" data-projectid="{{$project->id}}">Ajouter un enseignant</a>
              <a class="btn btn-primary" href="mailto:<?=$Mails; ?>?Subject={{$project->name}}">
                Envoyer un mail aux membres
              </a>
              <a class="btn btn-danger quitProject pull-right" data-projectid="{{$project->id}}" data-id="{{Auth::user()->id}}" style="float: right;">Quitter le projet</a>
            @endif
          </div>
        </div>

    </div>
  </div>
</div>
