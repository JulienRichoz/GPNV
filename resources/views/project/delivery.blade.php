<!--*********************** partie PRW2***********************
Created By: Fabio Marques
Description: Show the checkList "Livrables"
-->
<div class="trigger well well-sm" data-toggle="collapse" data-target=".deliverables" aria-expanded="false">
    <h1>Livrables</h1>
    <span class="glyphicon glyphicon-chevron-down disclosureIndicator"/>
</div>

<div class="deliverables collapse" data-projectid="{{$project->id}}">
    <div class="checkList">
        <div class="progressionCheckList">
            <div class="barre" style="background: linear-gradient(90deg, #20DE13 {{$livrables->getCompletedPercent()}}%, #efefef 0%);"></div>
            <p>{{$livrables->getNbItemsDone()}}/{{$livrables->getNbItems()}}</p>
        </div>
        <ul>
            <!-- Display all livrables -->
            @if($livrables->showToDo())
                @foreach($livrables->showToDo() as $checkListItem)
                    @include('checkList.show', array('checkListItem'=>$checkListItem, 'projectId'=>$project->id))
                @endforeach
            @endif
        </ul>
        <ul class="completed hidden">
            @if($livrables->showCompleted())
                @foreach($livrables->showCompleted() as $checkListItem)
                    @include('checkList.show', array('checkListItem'=>$checkListItem, 'projectId'=>$project->id))
                @endforeach
            @endif
        </ul>
        @if(Auth::user()->projects()->find($project->id))
            <a class="btn btn-warning addCheckList" data-id="{{$livrables->getId()}}" data-projectid="{{$project->id}}" data-URL="{{ URL('project') }}">Ajouter</a>
        @endif
        @if($livrables->getNbItemsDone())
            <a class="btn btn-warning changeView">Voir les éléments effectués</a>
            <a class="btn btn-warning changeView hidden">Cacher les éléments effectués</a>
        @endif
    </div>
</div>
