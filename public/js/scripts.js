$(document).ready(function() {
  function setCookie(cname, cvalue){
    var d = new Date();
    d.setTime(d.getTime() + (1*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  $('a.editDescription').click(function () {
    if($('a.saveDescription').is(':hidden')){
      $('#summernote').summernote();
      $('#summernote').css('display','None');
      $('div.note-editor').css('display','block');
      $('a.saveDescription').css('display','initial');
      $('a.editDescription').text("Quitter l'édition");
    }
    else{
      $('#summernote').css('display','block');
      $('div.note-editor').css('display','None');
      $('a.saveDescription').css('display','None');
      $('a.editDescription').text("Editer la description");
    }
  });

  $('a.saveDescription').click(function () {
    var description = $('#summernote').summernote('code');
    var projectid = this.getAttribute('data-projectid');
    $.ajax({
        url: projectid + "/editDescription/",
        type: "POST",
        data: { description: description },
        success: function() {
            bootbox.alert("Description modifiée avec succés.");
            location.reload();
        }
    });
  });

  $('button.createProject').click(function () {
      var description = $('#createDescription').summernote('code');
      $('#createDescription').val(description);
  });

  $(function() {
    $("#datepicker").datepicker();
    $('#createDescription').summernote();
  });

  $(function() {
    var theCookies = document.cookie.split(';');

    for (var i = 1 ; i <= theCookies.length; i++) {
      var Cookie = theCookies[i-1].trim();
      var FirstChar = Cookie.substr(0, 1);
      if(FirstChar=="." || FirstChar=="#"){
        var split = Cookie.split('=');
        var Value = split[1];
        split = split[0].split('_');

        var Class = split[0];
        var ProjectID = parseInt(split[1]);
        var Container = $("div"+Class);

        if(Container.attr('data-projectid')==ProjectID){
          if(Value=="true"){
            Container.addClass('in');
            $( "div[data-target='"+Class+"']" ).find("span.disclosureIndicator").removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
          }
          else{
            Container.removeClass('in');
            $( "div[data-target='"+Class+"']" ).find("span.disclosureIndicator").removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
          }
        }
      }
    }
  });

  /*$('span.glyphicon-chevron-down').click(function () {
    if(!$( this ).hasClass( "disclosureIndicator" )){
      $( this ).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
  });*/

  $('div').click(function () {
    var attribute = $( this ).attr("data-target");


    if(attribute!=null){
      var DivCollapse = $("div"+attribute);
      console.log("div"+attribute);

      if(!DivCollapse.hasClass("in")){
        $( this ).find("span.disclosureIndicator").removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        var CookieName = attribute + "_"+ DivCollapse.attr('data-projectid');
        setCookie(CookieName,"true");
      }
      else{
        $( this ).find("span.disclosureIndicator").removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        var CookieName = attribute + "_"+ DivCollapse.attr('data-projectid');

        if (document.cookie.indexOf(CookieName+"=") >= 0) {
          var projectid = DivCollapse.attr('data-projectid');
          setCookie(CookieName,"false");
        }
      }
    }
  });

  $('button.viewFile').click(function () {
      var fileID = this.getAttribute('data-fileid');
      var deliveryID = this.getAttribute('data-id');
  });

});
