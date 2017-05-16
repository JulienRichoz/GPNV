<!--
Created By: Fabio Marques
Description: Form to add a new item to a checkList
-->

<script type='text/javascript'>
  $(document).ready(function () {
    $("#form").submit(function(event) {
      event.preventDefault();
      var form = $( this ),
          url = form.attr( 'action' );

      $.ajax({
          url: url,
          type: 'POST',
          data: {name: $('#name').val()},
          success: function (data) {
              var result = $('<div />').append(data).find('.deliveriesData').html();
              $(".deliveriesData").html(result);
              bootbox.hideAll();
          }
      });
    });
  });
</script>

<form class="form-horizontal" role="form" method="POST" id="form" action="{{$projectId}}/checklist/{{$checkListId}}/create">
    {{ csrf_field() }}

    <div class="form-group">
        <label class="col-md-4 control-label">Nom*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
    </div>

    <div class="form-group">
        <!--<label class="col-md-4 control-label">Description</label>-->

        <div class="col-md-6">
          <input type="hidden" name="description" value="">
          <!--<textarea class="form-control" name="description"></textarea>-->
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary" onclick="">
                <i class="fa fa-btn fa-sign-in"></i>Créer
            </button>

        </div>
    </div>
</form>
