@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">

        <div class="col-xs-12 col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1>Intranet</h1>
            </div>
            <div class="panel-body">
              <a class="button btn btn-default synchro" href="{{ route('admin.sync') }}">Synchro</a>
              </br>

              @if(isset($Update) && $Update==true)
                @if(isset($NewTeachers) && count($NewTeachers)!=0)
                <div class="tree-menu" id="tree-menu">
                  <ul>
                    <li class="parent item-0 closed">
                      <a href="#"><span class="taskshow"><p>{{ count($NewTeachers) }} Nouveaux enseignants</p></span></a>
                      <ul style="display: none;">
                        @foreach( $NewTeachers as $User )
                        <li>
                          <a href="#"><span class="taskshow" data-id="2"><p>{{ $User->lastname }} {{ $User->firstname }}</p></span></a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
                @endif
                @if(isset($NewStudents) && count($NewStudents)!=0)
                <div class="tree-menu" id="tree-menu">
                  <ul>
                    <li class="parent item-0 closed">
                      <a href="#"><span class="taskshow"><p>{{ count($NewStudents) }} Nouveaux élèves</p></span></a>
                      <ul style="display: none;">
                        @foreach( $NewStudents as $User )
                        <li>
                          <a href="#"><span class="taskshow" data-id="2"><p>{{ $User->lastname }} {{ $User->firstname }}</p></span></a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
                @endif

                @if(isset($UpdateTeachers) && count($UpdateTeachers)!=0)
                <div class="tree-menu" id="tree-menu">
                  <ul>
                    <li class="parent item-0 closed">
                      <a href="#"><span class="taskshow"><p>{{ count($UpdateTeachers) }} Mise à jour enseignant</p></span></a>
                      <ul style="display: none;">
                        @foreach( $UpdateTeachers as $User )
                        <li>
                          <a href="#"><span class="taskshow" data-id="2"><p>{{ $User->lastname }} {{ $User->firstname }}</p></span></a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
                @endif
                @if(isset($UpdateStudents) && count($UpdateStudents)!=0)
                <div class="tree-menu" id="tree-menu">
                  <ul>
                    <li class="parent item-0 closed">
                      <a href="#"><span class="taskshow"><p>{{ count($UpdateStudents) }} Mise à jour élèves</p></span></a>
                      <ul style="display: none;">
                        @foreach( $UpdateStudents as $User )
                        <li>
                          <a href="#"><span class="taskshow" data-id="2"><p>{{ $User->lastname }} {{ $User->firstname }}</p></span></a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
                @endif
                @if(isset($DisabledUsers) && count($DisabledUsers)!=0)
                <div class="tree-menu" id="tree-menu">
                  <ul>
                    <li class="parent item-0 closed">
                      <a href="#"><span class="taskshow"><p>{{ count($DisabledUsers) }} Utilisateurs Hors-CPNV</p></span></a>
                      <ul style="display: none;">
                        @foreach( $DisabledUsers as $User )
                        <li>
                          <a href="#"><span class="taskshow" data-id="2"><p>{{ $User->lastname }} {{ $User->firstname }}</p></span></a>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
                @endif

              @elseif(isset($Update) && $Update==false)
                <div>Pas d'ajout ni de mise à jour dans la base de données</div>

              @endif
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1>Gestion types de tâche</h1>
            </div>
            <div class="panel-body">

              <div class="row">
                @include('tasktype.showAll')

                <div class="col-xs-12 col-lg-6">
                  <h4>Créer un type de tâche</h4>
                  <form method="post" id="addTaskType" action="{{route('taskType.store')}}">
                    {{ csrf_field() }}
                    <label for="name">Nom: </label>
                    <input type="text" name="name" value="" required>
                    </br>
                    <button type="submit" class="btn btn-primary" onclick="">
                        <i class="fa fa-btn fa-sign-in"></i>Créer
                    </button>
                  </form>
                </div>
              </div>




            </div>
          </div>
        </div>

      </div>



    </div>
@endsection
