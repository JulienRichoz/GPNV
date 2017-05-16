@extends('layouts.app')

@section('content')
<div class="scenario container">
  <div class="row">
    <form method="POST" action="{{route('scenario.modify', array('projectId' => $projectId, 'scenarioId' => $scenario->id))}}" class="col-xs-12 col-md-6 col-md-offset-3">
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
        <input @if($scenario->actif == 1) checked @endif name="actif" type="checkbox" data-toggle="toggle" data-onstyle="success" data-on="Validé" data-off="Non Validé">
      </div>
      <div class="form-group">
        <button class="btn btn-warning">Modifier</button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="elements col-xs-12 col-md-5">
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
              <form method="post" action="{{route('scenario.item.modify', array('projectId' => $projectId, 'scenarioId' => $scenario->id, 'itemId' => $step->id))}}">
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
                  <a href="{{route('scenario.del.item', array('projectId'=>$projectId, 'stepId'=>$step->id))}}" name="submit" class="btn btn-danger">
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
            <form method="post" action="{{route('scenario.create.item', array('projectId'=>$projectId, 'scenarioId'=>$scenario->id))}}">
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
    <div class="col-xs-12 col-md-3">
      <h2>Maquetes disponibles</h2>
      <div class="col-xs-12">
        @foreach($scenario->mockups as $mockup)
        <div style="text-align:center; margin-bottom:2px;">
          <img src="{{ URL::asset('mockups/'.$projectId.'/'.$scenario->id.'/'.$mockup->url)}}" style="max-width:100%; max-height: 200px;">
        </div>
        @endforeach
      </div>
      <div class="col-xs-12">
        <h4>Ajouter une maquette</h4>
        <form enctype="multipart/form-data" action="{{route('scenario.uploadMaquete', array('projectId'=>$projectId, 'scenarioId'=>$scenario->id))}}" method="post">
          {{ csrf_field() }}
          {{ method_field('POST') }}
          <div class="form-group">
            <input type="file" name="maquette" class="form-control" required>
          </div>
          <div class="form-group">
            <button name="button" class="btn btn-warning">Ajouter une maquette</button>
          </div>
        </form>
      </div>
    </div>
    <div class="maquette col-xs-12 col-md-4">
      <h2>Maquette</h2>
      <a href="{{ URL::asset('mockups/2/2/img58d2c235da868.jpg') }}" target="_blank"><img src="{{ URL::asset('mockups/2/2/img58d2c235da868.jpg') }}"/></a>
    </div>
  </div>
</div>

@endsection
