
@section('planning')
    <div class="panel panel-default">
        <div class="panel-heading">Votre planning</div>
        <div class="panel-body">
            {{--@include('planning.show', ['taskparent' => $project->tasksParent])--}}
        </div>
    </div> -->

    <div>
        <form id="search" method="POST" action="{{ route('search.store', $project->id) }}">
            {!! csrf_field() !!}
            <input name="search" type="text" placeholder="Mots-Clefs..."/>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Chercher
            </button>
        </form>
    </div>
@endsection
