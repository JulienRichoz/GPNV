<div class="col-xs-12 col-lg-6">
  <div class="panel panel-default">
      <!-- Display all project informations like the members, a description and so on -->
      <div class="panel-heading showPanel" data-toggle="collapse" data-target="#projectInfo">
        <h1>Informations du projet <span class="glyphicon glyphicon-chevron-up pull-right"></span></h1>
      </div>
      <div id="projectInfo" class="panel-body projectInfo collapse in" data-projectid="{{$project->id}}">
          <!-- Display the information about project -->
          <p>Nom : {{$project->name}}</p>
          <p>Date de début : {{$project->startDate}}</p>
          <p>
            Description :<br/>
            <div id="summernote">{!! $project->description !!}</div>
          </p>
          @if(Auth::user()->projects()->find($project->id))
            <a class="btn btn-primary editDescription">Editer la description</a>
            <a class="btn btn-success saveDescription" data-projectid="{{$project->id}}" style="display:none;">Sauvegarder description</a>
          @endif
      </div>
  </div>
</div>
