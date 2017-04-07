<div class="scenario">
  <h1>Scénario: {{$scenario->name}}</h1>
  <p>{{$scenario->description}}</p>
<form method="post" action="./{{$scenario->id}}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="elements">
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
        @foreach($scenario->steps as $step)
          <tr data-stepId="{{$step->id}}" data-imgurl="{{ URL::asset('images/{{-- $step->mockup --}}') }}">
            <td name="order{{$step->id}}">{{ $step->order }}</td>
            <td name="action{{$step->id}}">{{ $step->action }}</td>
            <td name="reponse{{$step->id}}">{{ $step->result }}</td>
            <td><button name="submit" value="delete{{$step->id}}">Delete</button>
            <!--<td>
              <textarea></textarea>
              <i class="btn btn-success fa fa-check validate"></i>
              <i class="btn btn-danger fa fa-times reject"></i>
              <input type="hidden" value="" name="state">
            </td>-->
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <button>Enregistrer les modifications</button>
  <div class="maquette">
    <h2>Maquette</h2>
    <a href="{{ URL::asset('images/scenario1.png') }}" target="_blank"><img src=""/></a>
  </div>
</form>
<form method="post" action="./{{$scenario->id}}/create">
  {{ csrf_field() }}
  {{ method_field('POST') }}
  <label for="action">Action</label>
  <textarea id="action" name="action"></textarea>
  <label for="reponse">Réponse</label>
  <textarea id="reponse" name="reponse"></textarea>
  <button>Ajouter un étape</button>
</form>
</div>
