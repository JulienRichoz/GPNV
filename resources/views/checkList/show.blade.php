<!--
  Created By: Fabio Marques
  Description: View to show each item of the checkList
-->
<li class="livrableShow">
  <form method="post" action="./id/{{$checkListItem->id}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <label>{{$checkListItem->title}}</label>
    <input name="done" onchange="this.form.submit()" type="checkbox" @if($checkListItem->done) checked @endif>
  </form>
</li>
