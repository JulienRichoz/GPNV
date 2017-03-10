<!--
  Created By: Fabio Marques
  Description: View to show each item of the checkList
-->
<li class="checkListShow">
  <form method="post" action="./id/{{$checkListItem->id}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <a @if(isset($modalBox) && $modalBox) class="showScenario" data-id="{{$checkListItem->id}}" data-URL="{{ URL('project') }}" @endif><label>{{$checkListItem->title}}</label></a>
    <input name="done" onchange="this.form.submit()" type="checkbox" @if($checkListItem->done) checked @endif>
  </form>
</li>
