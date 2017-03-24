$(document).ready(function() {
  $('button.createProject').click(function () {
      var description = $('#createDescription').summernote('code');
      $('#createDescription').val(description);
  });

  $(function() {
    $("#datepicker").datepicker();
    $('#createDescription').summernote();
  });

  $('span.glyphicon-chevron-down').click(function () {
    $( this ).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
  });

});
