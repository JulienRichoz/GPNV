<div class="col-md-12 detailsContainer">
    <div class="panel panel-default">
        <div class="panel-heading">{{$task->name}}</div>

        <div class="panel-body">
            <p>Durée initial : {{$task->duration}}</p>
            @if($task->getObjective())
              <p>Objectif : {{$task->getObjective()->title}}</p>
            @endif
            @if(isset($actualTaskType))
              <p>Type de tâche: {{$actualTaskType->name}}</p>
            @endif
        </div>

        <div class="panel-heading">Avancement</div>

        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>De</th>
                    <th>à</th>
                    <th>Nom de l'utilisateur</th>
                    <th>Durée</th>
                </tr>
                <!-- Display user rush about a task -->
                @foreach($task->usersTasks as  $usertask)
                    @foreach($usertask->durationsTasks as $duration)
                        @if($duration->ended_at)
                            <tr>
                                <td>{{$duration->created_at}}</td>
                                <td>{{$duration->ended_at}}</td>
                                <td>{{$usertask->user->fullName}}</td>
                                <td>{{round(abs(strtotime($duration->ended_at) - strtotime($duration->created_at))). " secondes"}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>
        </div>

        <div class="panel-heading">Commentaires</div>

        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Commentaire</th>
                    <th>Crée le</th>
                    <th>Nom de l'utilisateur</th>
                </tr>
                <!-- Display the comment for a task -->
                @foreach($task->comments as  $comment)
                    <tr>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->user->fullName}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="{{route('comment.store', $task->id)}}">
                {!! csrf_field() !!}
                <textarea name="comment" rows="8" cols="45" placeholder="Tapez votre commentaire ici"></textarea>
                <br/>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Envoyer
                </button>
            </form>

        </div>


    </div>
</div>
