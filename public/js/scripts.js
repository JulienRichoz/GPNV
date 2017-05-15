$(document).ready(function() {
  window.setCookie = function(cname, cvalue, path=null){
    if(!path) path="/";
    var d = new Date();
    d.setTime(d.getTime() + (1*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path="+path;
  }
  window.getCookies = function() {
    var c = document.cookie, v = 0, cookies = {};
    if (document.cookie.match(/^\s*\$Version=(?:"1"|1);\s*(.*)/)) {
        c = RegExp.$1;
        v = 1;
    }
    if (v === 0) {
        c.split(/[,;]/).map(function(cookie) {
            var parts = cookie.split(/=/, 2),
                name = decodeURIComponent(parts[0].trimLeft()),
                value = parts.length > 1 ? decodeURIComponent(parts[1].trimRight()) : null;
            cookies[name] = value;
        });
    } else {
        c.match(/(?:^|\s+)([!#$%&'*+\-.0-9A-Z^`a-z|~]+)=([!#$%&'*+\-.0-9A-Z^`a-z|~]*|"(?:[\x20-\x7E\x80\xFF]|\\[\x00-\x7F])*")(?=\s*[,;]|$)/g).map(function($0, $1) {
            var name = $0,
                value = $1.charAt(0) === '"'
                          ? $1.substr(1, -1).replace(/\\(.)/g, "$1")
                          : $1;
            cookies[name] = value;
        });
    }
    return cookies;
  }
  window.getCookie = function(name) {
      return getCookies()[name];
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
    var theCookies = Object.keys(getCookies());
    for (var i = 0; i < theCookies.length; i++) {
      if (theCookies[i].startsWith('#')){
        var cookie = getCookie(theCookies[i]);
        if(cookie == 'true'){
          $(theCookies[i]).toggleClass("in");
          if(theCookies[i].startsWith('#users'))
            $(theCookies[i]).parent().children('h4').children('span').toggleClass("glyphicon-chevron-down glyphicon-chevron-up");
          else
            $(theCookies[i]).parent().children('.showPanel').children('h1').children('span').toggleClass("glyphicon-chevron-down glyphicon-chevron-up");
        }
      }
    }
  });

  // provisory task filters management
  $(function() {
    var theCookies = Object.keys(getCookies());
    for (var i = 0; i < theCookies.length; i++) {
      if (theCookies[i].startsWith('#check')){
        var cookie = getCookie(theCookies[i]);
        if(cookie == 'true'){
          $(theCookies[i]).prop('checked', true);
          console.log(theCookies[i] + " set to true");
        } else {
          $(theCookies[i]).prop('checked', false);
          console.log(theCookies[i] + " set to false");
        }
      }
    }
  });


  $('.showPanel').click(function(){
    $(this).children('h1').children('span').toggleClass("glyphicon-chevron-down glyphicon-chevron-up");
    var cookieName = $(this).attr('data-target');
    if(cookieName!=null){
      var cookieValue = getCookie(cookieName);
      if(cookieValue && cookieValue == 'true')
        setCookie(cookieName, 'false', document.location.pathname);
      else
        setCookie(cookieName, 'true', document.location.pathname);
    }
  });
  $('.showMembres').click(function(){
    $(this).children('span').toggleClass("glyphicon-chevron-down glyphicon-chevron-up");
    var cookieName = $(this).attr('data-target');
    if(cookieName!=null){
      var cookieValue = getCookie(cookieName);
      if(cookieValue && cookieValue == 'true')
        setCookie(cookieName, 'false');
      else
        setCookie(cookieName, 'true');
      console.log(cookieValue);
    }
  });

  $('button.viewFile').click(function () {
      var fileID = this.getAttribute('data-fileid');
      var deliveryID = this.getAttribute('data-id');
  });

});
