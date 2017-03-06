<form class="form-horizontal" role="form" method="POST" action="{{ route('project.addUsers', $project->id) }}">
   {!! csrf_field() !!}
     <div class="checkbox">
        @foreach($users as $user)
          <label class="userlist">
              <input type="checkbox" name="user[{{$user->id}}]">
              @include('user.avatar', ['user' => $user])
          </label>
        @endforeach
     </div>
     <br>
     <div class="form-group">
         <div class="col-md-6 col-md-offset-4">
             <button type="submit" class="btn btn-primary">
                 <i class="fa fa-btn fa-plus"></i>Ajouter un/des utilisateur(s)
             </button>
         </div>
     </div>
</form>
