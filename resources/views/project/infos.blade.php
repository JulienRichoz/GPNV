<div class="trigger well well-sm" data-toggle="collapse" data-target=".projectInfo" aria-expanded="false">
    <h1>Informations du projet</h1>
    <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
</div>

<div class="projectInfo collapse">
    <!-- Display all project informations like the members, a description and so on -->
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Display the information about project -->
            <p>Nom : {{$project->name}}</p>
            <p>Date de début : {{$project->startDate}}</p>
            <p>
              Description :<br/>
              <div id="summernote">{!! $project->description !!}</div>
            </p>
            <a class="btn btn-warning editDescription">Editer la description</a>
            <a class="btn btn-warning saveDescription" data-projectid="{{$project->id}}" style="display:none;">Sauvegarder description</a>
        </div>
    </div>
</div>
