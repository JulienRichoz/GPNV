<form class="form-horizontal" role="form" method="POST" action="checkList/{{$checkListId}}/create">
    {{ csrf_field() }}

    <div class="form-group">
        <label class="col-md-4 control-label">Nom</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name"  required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
          <textarea class="form-control" name="description" required></textarea>
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
