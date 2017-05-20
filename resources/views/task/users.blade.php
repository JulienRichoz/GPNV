<script type='text/javascript'>
    $(document).ready(function () {
        $("#manageUsersForm").submit(function(event) {
            event.preventDefault();
            var form = $( this ), url = form.attr( 'action' );

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serializeArray(),
                success: function (data) {
                    console.log("Task successfully delegated!");
                    console.log(data);
                    refreshDisplayedTasks(); // refresh the task list

                    // Display a confirmation message to the user
                    var bootBoxContainer = $('#manageUsersButton').closest('.bootbox-body');
                    bootBoxContainer.html('<p>Attribution à la tâche effectuée avec succès !</p>');
                }
            });
            /*var fields = $( this ).serializeArray()
            jQuery.each( fields, function( i, field ) {
                console.log(field);
            });*/
        });
    });
</script>

<table class="table">
    <tr>
        <th>Utilisateur</th>
        <th>Action</th>
    </tr>
    @foreach($userstask as $usertask)
        <tr>
            <td>@include('user.avatar', ['user' => $usertask->user])</td>
            <td style="text-align: center;">
                <!-- If a user doesn't begin a task, he can be deleted -->
                @if($usertask->durationsTasks->isEmpty())
                <button class="btn usertaskdestroy" data-id="{{$usertask->id}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                @else
                    <p>Suppression impossible</p>
                @endif
            </td>
        </tr>
    @endforeach
</table>

<hr>
<h4>Ajouter des participant à la tâche</h4>

<form class="form-horizontal" role="form" method="POST" id="manageUsersForm" action="{{Route('tasks.storeUsers',$task->id)}}">
    {!! csrf_field() !!}
    <div class="checkbox">
        @foreach($project->users as $user)
            <!-- Display all users which aren't in the project -->
            @if(!in_array($user->id,$refuse))
                <label>
                    <input type="checkbox" name="user[{{$user->id}}]">
                    @include('user.avatar', ['user' => $user])
                </label>
            @endif

        @endforeach
    </div>

<br>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary" id="manageUsersButton">
                <i class="fa fa-btn fa-plus"></i>Attribuer
            </button>
        </div>
    </div>
</form>