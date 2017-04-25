
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/project/'.$project.'/tasks') }}">
        {!! csrf_field() !!}
        <?php
          use App\Models\CheckList;
          $objectifs = new CheckList('Project', $project, 'Objectifs', 'project/scenario');
        ?>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Nom de la tâche</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Durée de la tâche (h)</label>

            <div class="col-md-6">
                <input type="number" class="form-control" name="duration" min="1" value="{{ old('duration') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Tache Racine</label>

            <div class="col-md-6">
                <select class="form-control" name="root_task" required>
                  @if($objectifs->showToDo())
                    @foreach($objectifs->showToDo() as $checkListItem)
                      <option name="" value="{{ $checkListItem->id }}">{{ $checkListItem->title }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <input type="hidden" class="form-control" name="project_id" value="{{$project}}" required>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Créer
                </button>

            </div>
        </div>
    </form>
