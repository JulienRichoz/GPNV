@extends('layouts.app')

@section('content')
<div class="scenario container">
  <div class="row">
    <form method="POST" action="" class="col-xs-12 col-md-6 col-md-offset-3">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form-group">
        <label for="name">Nom:</label>
        <input class="form-control" type="text" name="name" value="{{$scenario->name}}">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" rows="8">{{$scenario->description}}</textarea>
      </div>
      <div class="form-group">
        <input name="actif" type="checkbox" data-toggle="toggle" data-onstyle="success" data-on="Validé" data-off="Non Validé">
      </div>
      <div class="form-group">
        <button class="btn btn-warning">Modifier</button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="elements col-xs-12 col-md-6">
      <h2>Etapes</h2>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Action</th>
            <th>Réponse</th>
            <th>Modif</th>
            <!--<th>Résultat</th>-->
          </tr>
        </thead>
        <tbody>
          <?php $order=0;?>
          @foreach($scenario->steps as $step)
            <?php $order++;?>
            <tr data-stepId="{{$step->id}}" data-imgurl="{{ URL::asset('images/{{-- $step->mockup --}}') }}">
              <form method="post" action="#">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{$step->id}}">
                <input type="hidden" name="order" value="{{ $step->order }}">
                <td name="order">{{ $order }}</td>
                <td ><textarea name="action" class="form-control">{{ $step->action }}</textarea></td>
                <td ><textarea name="reponse" class="form-control">{{ $step->result }}</textarea></td>
                <td>
                  <button type="submit" class="btn btn-warning">
                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                  </button>
                  <a href="./{{$step->id}}/delete" name="submit" class="btn btn-danger">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                </td>
              </form>
              <!--<td>
                <textarea></textarea>
                <i class="btn btn-success fa fa-check validate"></i>
                <i class="btn btn-danger fa fa-times reject"></i>
                <input type="hidden" value="" name="state">
              </td>-->
            </tr>
          @endforeach
          <tr>
            <form method="post" action="./{{$scenario->id}}/create">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <td>n°</td>
              <td><textarea id="action" name="action" class="form-control"></textarea></td>
              <td><textarea id="reponse" name="reponse" class="form-control"></textarea></td>
              <td><button class="btn btn-success">Ajouter un étape</button></td>
            </form>
          </tr>
        </tbody>
      </table>

    </div>
    <div class="maquette col-md-6">
      <h2>Maquette</h2>
      <a href="{{ URL::asset('images/scenario1.png') }}" target="_blank"><img src=""/></a>
    </div>
  </div>
</div>

@endsection
