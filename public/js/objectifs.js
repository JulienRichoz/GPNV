$(document).on("click", '.showObjectif', function(event) {
    var id = this.getAttribute('data-id');
    var projectId = this.getAttribute('data-projectid');
    var baseUrl = this.getAttribute('data-URL');
    $.get(baseUrl+"/"+projectId+"/checkListItem/"+id, {}, function (form) {
        bootbox.dialog({
            message: form
        });

        $('.addScenario').click(function () {
          var id = this.getAttribute('data-id');
          var projectId = this.getAttribute('data-projectid');
          var baseUrl = this.getAttribute('data-URL');
          $.get(baseUrl+"/"+projectId+"/checkListItem/"+id+"/scenario/create", {}, function (form) {
              bootbox.dialog({
                  message: form,
                    cancel: {
                        label: 'Quitter',
                        className: 'btn-danger'
                    }
              });
          });
        });

        $('.showScenario').click(function () {
            var id = this.getAttribute('data-id');
            var projectId = this.getAttribute('data-projectid');
            var baseUrl = this.getAttribute('data-URL');
            var scenarioId = $(this).parent().children('div.form-group').children('select').val();
            window.location.href = baseUrl+"/"+projectId+"/scenario/"+scenarioId;
            /*$.get(baseUrl+"/"+projectId+"/scenario/"+id, {}, function (form) {
                bootbox.dialog({
                    message: form,
                    className: "modalScenario",
                    buttons: {
                      confirm: {
                          label: 'Valider',
                          className: 'btn-success',
                          callback:''
                      },
                      cancel: {
                          label: 'Quitter',
                          className: 'btn-danger'
                      }
                    }
                });

                $('.scenario table tr').click(function(){
                  $('.scenario table .active').toggleClass('active');
                  $(this).toggleClass('active');
                  $('.maquette img').attr("src",$(this).data('imgurl'));
                  $('.maquette a').attr("href", $(this).data('imgurl'));
                });

                $('.scenario .validate').click(function(){
                  $(this).parent().parent().removeClass('danger');
                  $(this).parent().parent().addClass('success');
                  $(this).siblings( "input[name=state]" ).val("true");
                });

                $('.scenario .reject').click(function(){
                  $(this).parent().parent().removeClass('success');
                  $(this).parent().parent().addClass('danger');
                  $(this).siblings( "input[name=state]" ).val("false");
                });
            });*/
        });
    });
  });
