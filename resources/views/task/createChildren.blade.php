<script type='text/javascript'>
    $(document).ready(function () {
        $("#createChildTaskForm").submit(function(event) {
            event.preventDefault();
            var form = $( this ), url = form.attr( 'action' );

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serializeArray(),
                success: function (data) {
                    // console.log("Child task successfully added!");
                    refreshDisplayedTasks(); // refresh the task list

                    // Display a confirmation message to the user
                    var bootBoxContainer = $('#createChildTaskButton').closest('.bootbox-body');
                    bootBoxContainer.html('<p>Sous-tâche ajoutée avec succès !</p>');
                }
            });
            /*var fields = $( this ).serializeArray()
            jQuery.each( fields, function( i, field ) {
                console.log(field);
            });*/
        });
    });
</script>

<form class="form-horizontal" role="form" method="POST" id="createChildTaskForm" action="{{ url('/tasks/'.$task->id.'/children') }}">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Nom de la tâche</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Durée de la tâche (h)</label>

        <div class="col-md-6">
            <input type="number" class="form-control" min="1" name="duration" value="{{ old('duration') }}" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <input type="hidden" class="form-control" name="project_id" value="{{ $task->project_id }}" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <input type="hidden" class="form-control" name="parent_id" value="{{ $task->id }}" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary" id="createChildTaskButton">
                <i class="fa fa-btn fa-sign-in"></i>Créer
            </button>

        </div>
    </div>
</form>
