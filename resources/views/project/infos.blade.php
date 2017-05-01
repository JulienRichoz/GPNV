<div class="panel panel-default">
    <!-- Display all project informations like the members, a description and so on -->
    <div class="panel-heading" data-toggle="collapse" data-target=".projectInfo">
      <div class="trigger" aria-expanded="false">
          <h1>Informations du projet</h1>
          <span class="glyphicon glyphicon-chevron-up disclosureIndicator"/>
      </div>
    </div>
    <div class="panel-body projectInfo collapse in" data-projectid="{{$project->id}}">
        <!-- Display the information about project -->
        <p>Nom : {{$project->name}}</p>
        <p>Date de début : {{$project->startDate}}</p>
        <p>
          Description :<br/>
          <div id="summernote">{!! $project->description !!}</div>
        </p>
        @if(Auth::user()->projects()->find($project->id))
          <a class="btn btn-warning editDescription">Editer la description</a>
          <a class="btn btn-warning saveDescription" data-projectid="{{$project->id}}" style="display:none;">Sauvegarder description</a>
        @endif
    </div>
</div>
