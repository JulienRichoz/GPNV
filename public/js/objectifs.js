$('.showObjectif').click(function () {
    var id = this.getAttribute('data-id');
    var projectId = this.getAttribute('data-projectid');
    var baseUrl = this.getAttribute('data-URL');
    $.get(baseUrl+"/"+projectId+"/checkListItem/"+id, {}, function (form) {
        bootbox.dialog({
            message: form
        });
    });
  });
