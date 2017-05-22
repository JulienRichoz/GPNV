$(document).ready(function() {
  setCookie = function(cname, cvalue, path=null){
    if(!path) path="/";
    var d = new Date();
    d.setTime(d.getTime() + (1*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path="+path;
  }
  getCookies = function() {
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
  getCookie = function(name) {
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
        success: function (data) {
            bootbox.alert("Description modifiée avec succés.");
            var result = $('<div />').append(data).find('#summernote').html();
            $("#summernote").html(result);
            $('#summernote').css('display','block');
            $('div.note-editor').css('display','None');
            $('a.saveDescription').css('display','None');
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

  // ------------------------ Task filter management ------------------------
  // Displays / hides tasks according to the active filters
  refreshDisplayedTasks = function() {
    var projectId = $('.projectTasks').attr('data-projectid');
    var status = [];
    $(".checkboxFilter").each(function(checkbox) {
      if (this.checked) {
        status.push($(this).attr('data-status'));
      }
    });

    var taskOwner = $(".dropTaskFilter .owner li a.activeOwner").attr("data-taskOwner");
    var taskObjective = $(".dropTaskFilter .objective li a.activeOwner").attr("data-objective");

    //console.log(status);

    $.ajax({
      url: projectId + "/getTasks",
      type: 'get',
      data: {status: status, taskOwner: taskOwner, taskObjective: taskObjective},
      success: function (tasks) {
        //console.log(tasks);
        $("#tree-menu ul").html(tasks);
      },
      error: function() {
        console.log("failed to load project tasks");
      }
    });
  }

  // Checkbox filters management
  $(function() {
    var theCookies = Object.keys(getCookies());
    for (var i = 0; i < theCookies.length; i++) {
      if (theCookies[i].startsWith('#check')){
        var cookie = getCookie(theCookies[i]);
        var checkStatus = (cookie == 'true');

        $(theCookies[i]).prop('checked', checkStatus);
        console.log(theCookies[i] + " set to true");
      }
    }
  });

  // Dropdown filters management
  $(function() {
    var theCookies = Object.keys(getCookies());
    var cookieValues = Object.values(getCookies());

    var expr = "Dropdown";

    for (var i = 0; i < theCookies.length; i++) {
      var componentNameIndex = theCookies[i].search(expr);
      if (componentNameIndex != -1){
        // ex: extracts 'people' from #peopleDropdown
        var componentName = theCookies[i].substr(1, componentNameIndex - 1);
        // Gets the index of the containing <li> within the <ul>
        var listItemIndex = cookieValues[i];

        switch (componentName) {
          case 'people':
            $(".dropTaskFilter .owner li a").removeClass("activeOwner");
            var listItem = $(".dropTaskFilter .owner li").get(listItemIndex);
            var targetLink = $(listItem).find('a').first();
            targetLink.addClass("activeOwner");
            // Updating dropdown button text
            $("#dropdownTitleOwner").html(targetLink.text())
            break;
          case 'objectives':
            $(".dropTaskFilter .objective li a").removeClass("activeObjective");
            var listItem = $(".dropTaskFilter .objective li").get(listItemIndex);
            var targetLink = $(listItem).find('a').first();
            targetLink.addClass("activeObjective");
            $("#dropdownTitleObjective").html(targetLink.text());
            break;

          default:
            console.log('No');
        }
      }
    }
    window.refreshDisplayedTasks();
  });

});
