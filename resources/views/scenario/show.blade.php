<div class="scenario">
  <h1>Scénario: Créer un nouveau project</h1>
  <p>Se scénario permet de vérifier si l'application fonctionne correctement</p>
<form>
  <div class="elements">
    <h2>Elements</h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Action</th>
          <th>Réponse</th>
          <th>Résultat</th>
        </tr>
      </thead>
      <tbody>
        <tr data-imgurl="{{ URL::asset('images/scenario1.png') }}">
          <td>1</td>
          <td>Cliquer sur le bouton "Créer un nouveau project"</td>
          <td>la page nouveau project s'affiche</td>
          <td>
            <textarea></textarea>
            <i class="btn btn-success fa fa-check validate"></i>
            <i class="btn btn-danger fa fa-times reject"></i>
            <input type="hidden" value="" name="state">
          </td>
        </tr>
        <tr data-imgurl="{{ URL::asset('images/scenario2.png') }}">
          <td>2</td>
          <td>Cliquer sur le bouton "Créer un nouveau project"</td>
          <td>la page nouveau project s'affiche</td>
          <td>
            <textarea></textarea>
            <i class="btn btn-success fa fa-check validate"></i>
            <i class="btn btn-danger fa fa-times reject"></i>
            <input type="hidden" value="" name="state">
          </td>
        </tr>
        <tr data-imgurl="{{ URL::asset('images/scenario3.png') }}">
          <td>3</td>
          <td>Cliquer sur le bouton "Créer un nouveau project"</td>
          <td>la page nouveau project s'affiche</td>
          <td>
            <textarea></textarea>
            <i class="btn btn-success fa fa-check validate"></i>
            <i class="btn btn-danger fa fa-times reject"></i>
            <input type="hidden" value="" name="state">
          </td>
        </tr>
        <tr data-imgurl="{{ URL::asset('images/scenario4.png') }}">
          <td>4</td>
          <td>Cliquer sur le bouton "Créer un nouveau project"</td>
          <td>la page nouveau project s'affiche</td>
          <td>
            <textarea></textarea>
            <i class="btn btn-success fa fa-check validate"></i>
            <i class="btn btn-danger fa fa-times reject"></i>
            <input type="hidden" value="" name="state">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="maquette">
    <h2>Maquette</h2>
    <a href="{{ URL::asset('images/scenario1.png') }}" target="_blank"><img src=""/></a>
  </div>
</form>
</div>
