<div class="well well-sm" style="max-height: 35px;">
    <div class="media">
        <div class="media-body">
        	<!-- Display the fullname and the email -->

          <h5 class="media-heading">{{$user->fullname}}</h5>

          @if(Auth::user()->role_id==2 && isset($inProject))
          <button class="btn removeUser" data-id="{{$user->id}}" data-projectid="{{$project->id}}">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>

          @if(isset($projectName))
            <a href="mailto:{{$user->mail}}?Subject=<?=str_replace(' ', '%20', $projectName)?>" style="color:unset;">
          @else
            <a href="mailto:{{$user->mail}}" style="color:unset;">
          @endif
              <button class="btn sendMail">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
              </button>
            </a>
          @endif
        </div>
    </div>
</div>
