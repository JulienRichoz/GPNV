<!--
  Created By: Fabio Marques
  Description: View to show each item of the checkList
-->
<!--
  <div class="well well-sm checkListShow" style="max-height: 35px;">
-->
<div class="well well-sm" style="max-height: 35px;">
    <div class="media">
        <div class="media-body">
          <form method="post" action="{{$projectId}}/id/{{$checkListItem->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <input name="done" class="styled custom-control-input" onchange="this.form.submit()" type="checkbox" @if($checkListItem->done) checked @endif>
            <a @if(isset($modalBox) && $modalBox) class="showObjectif" data-id="{{$checkListItem->id}}" data-projectid="{{$project->id}}" data-URL="{{ URL('project') }}" @endif><label>{{$checkListItem->title}}</label></a>
            <input type="hidden" id="validate" name="validate" value="true"/>
          </form>
        </div>
    </div>
</div>
