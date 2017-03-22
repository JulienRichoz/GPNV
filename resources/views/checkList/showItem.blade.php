<div class="objectif">
  <form>
    <div class="form-group">
      <label for="name">Nom</label>
      <input id="name" type="text" class="form-control" value="{{$item->title}}">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" class="form-control">{{$item->description}}</textarea>
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
        <option value="12">Test</option>
        @foreach($scenarios as $scenario)
          <option value="{{$scenario->id}}">{{$scenario->name}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-default">Afficher</button>
    <a href="#" class="btn btn-default">Créer nouveau scénario</a>
  </form>

  @endif
</div>
