@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="button btn btn-default synchro" href="{{ url('/admin/sync') }}">Synchro Intranet</a>
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
@endsection
