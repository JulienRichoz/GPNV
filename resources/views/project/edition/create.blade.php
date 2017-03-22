@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Création de projet</div>

                    <div class="panel-body">

                    </div>
                    <form class="form-horizontal" id="createProject" role="form" method="POST" action="{{ url('/project') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Nom de votre projet</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="description" id="createDescription" value="{{ old('description') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Date de début</label>

                            <div class="col-md-3">
                                <input type="date" class="form-control" name="date" id="datepicker" value="{{ date('d/m/Y') }}" required>
                            </div>
                            <label class="col-md-1 control-label">à :</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="hour" id="" value="{{ date('H:i:s') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary createProject">
                                    <i class="fa fa-btn fa-sign-in"></i>Créer
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
