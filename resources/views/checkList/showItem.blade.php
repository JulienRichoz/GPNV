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
  <form class="form-inline">
    <div class="form-group">
      <label for="scenario">Scénario: </label>
      <select id="scenario" class="form-control">
        @foreach($scenarios as $scenario)
          <option value="{{$scenario->id}}">{{$scenario->name}}</option>
        @endforeach
      </select>
    </div>
    @if(count($scenarios)>0)
      <button type="submit" class="btn btn-default">Afficher</button>
    @endif
    <a class="addScenario" data-id="{{$item->id}}" data-projectid="{{$projectId}}" data-URL="{{ URL('project') }}" class="btn btn-default"><label>Créer nouveau scénario</label></a>
  </form>

  @endif
</div>
