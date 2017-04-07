<div class="objectif">
  <form method="post" action="{{$projectId}}/id/{{$item->id}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="name">Nom</label>
      <input id="name" name="title" type="text" class="form-control" value="{{$item->title}}">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" class="form-control">{{$item->description}}</textarea>
    </div>
    <button type="submit" class="btn btn-default">Sauvegarder</button>
  </form>
  <br>
  <br>
  @if(isset($scenarios))
  <form method="post" action="{{$projectId}}/scenario">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="form-group">
      <label for="scenario">Scénario</label>
      @if(count($scenarios)>0)
        <pre>{{$scenarios[0]->steps}}</pre>
        <select id="scenario" name="scenario" class="form-control">
          @foreach($scenarios as $scenario)
            <option value="{{$scenario->id}}">{{$scenario->name}}</option>
          @endforeach
        </select>
      @else
        <p>Aucun scénario disponible</p>
      @endif
    </div>
      @if(count($scenarios)>0)
        <a data-projectid="{{$projectId}}" data-URL="{{ URL('project') }}" class="btn btn-default showScenario">Afficher</a>
        <button type="submit" class="btn btn-default">Supprimer</button>
      @endif
      <a data-id="{{$item->id}}" data-projectid="{{$projectId}}" data-URL="{{ URL('project') }}" class="btn btn-default addScenario">Créer nouveau scénario</a>
  </form>

  @endif
</div>
