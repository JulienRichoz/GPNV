@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Non connecté</div>
                <div class="panel-body">
                  Il semblerait que vous ne soyez pas connecté au site <a href="http://intranet.cpnv.ch">intranet.cpnv.ch</a>.</br>
                  Si c'est fait vous pouvez <a href="/">recharger la page</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
