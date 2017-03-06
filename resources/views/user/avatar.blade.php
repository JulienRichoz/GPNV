<div class="well well-sm" style="max-height: 70px;">
    <div class="media">
        <div class="media-body">
        	<!-- Display the fullname and the email -->
            <h4 class="media-heading">{{$user->fullname}}</h4>
            <p>{{$user->mail}}</p>
            @if(Auth::user()->role_id==2 && isset($inProject))
            <button class="btn removeUser" data-id="{{$user->id}}" data-projectid="{{$project->id}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>
            @endif
        </div>
    </div>
</div>
