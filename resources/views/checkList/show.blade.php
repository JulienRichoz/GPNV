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
          <form method="post" id="updateState" action="{{$projectId}}/id/{{$checkListItem->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @if(isset($modalBox))
              <a class="btn removeObjective pull-right" data-id="{{$checkListItem->id}}" data-projectid="{{$project->id}}" style="position: relative;top: -8px;background-color: unset;">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </a>
            @endif

            @if(isset($modalBox) && $modalBox)
              <a class="showObjectif" data-id="{{$checkListItem->id}}" data-projectid="{{$project->id}}" data-URL="{{ URL('project') }}">

            @else
              <a>
            @endif

              <label>{{$checkListItem->title}}</label>
              @if(isset($scenarios))
                <label class="pull-right">
                @if($scenarios['allComplete'])
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                @elseif($scenarios['nbScenarios']!=0)
                  {{$scenarios['nbScenarios']}}/{{$scenarios['nbValidateScenarios']}}/{{$scenarios['nbCompletedScenarios']}}
                @else
                  ?
                @endif
                </label>
              @endif
            </a>

            @if(isset($file))
              <a class="btn removeDelivery pull-right" data-id="{{$checkListItem->id}}" data-projectid="{{$project->id}}" style="position: relative;top: -8px;background-color: unset;">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </a>
              @if(isset($fileData->id))
                <a class="btn removeLink pull-right" data-id="{{$checkListItem->id}}" style="position: relative;top: -8px;background-color: unset;">
                    <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                </a>
                <a class="btn viewFile pull-right" data-fileid="{{$fileData->id}}" data-id="{{$checkListItem->id}}" style="position: relative;top: -8px;background-color: unset;"
                  onclick="window.open('{{asset('files/'.$project->id.'/'.$fileData->url)}}', '_blank');">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
              @elseif($fileData!=null)
                <a class="btn removeLink pull-right" data-id="{{$checkListItem->id}}" style="position: relative;top: -8px;background-color: unset;">
                    <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                </a>
                <a class="btn pull-right" data-id="{{$checkListItem->id}}" style="position: relative;top: -8px;background-color: unset;" onclick="window.open('{{$fileData}}', '_blank');">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
              @else
                <a class="btn linkDelivery pull-right" data-id="{{$checkListItem->id}}" data-projectid="{{$project->id}}" style="position: relative;top: -8px;background-color: unset;">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
              @endif
            @endif

            <input type="hidden" id="validate" name="validate" value="true"/>
          </form>
        </div>
    </div>
</div>
