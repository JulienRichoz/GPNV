/**
* Allow the drag & drop action and preventDefault
* @param ev the element dragged
*/
function allowDrop(ev) {
    ev.preventDefault();
}

/**
* transfer data on drag action
* @param ev the element dragged
*/
function drag(ev) {
    ev.dataTransfer.setData("url", ev.target.src);
    ev.dataTransfer.setData("id", ev.target.id);
}

/**
* change step image on drop
* @param ev element dragged
*/
function drop(ev) {
    ev.preventDefault();
    var url = ev.dataTransfer.getData("url");
    var id = ev.dataTransfer.getData("id");
    ev.target.src = url;
    ev.target.parentElement.href = url;

    var mockup = $(".tableRow.active input[name='mockup']");
    var mockupUrl = $(".tableRow.active input[name='mockupUrl']");
    var stepId = $(".tableRow.active input[name='id']");
    var token = $(".tableRow.active input[name='_token']");

    mockup.val(id);
    mockupUrl.val(url);

    var data = "_method=PUT&_token="+token.val()+"&mockupId="+mockup.val()+"&stepId="+stepId.val();
    $.ajax({
      url : update_image_route,
      type : 'POST',
      data : data
    })
}

/**
* Delete the image from HTML
* @param id Html element id
*/
function remove(id) {
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}
/**
* delete the image
* @param ev Element dragged
*/
function delPicture(ev){
  ev.preventDefault();
  var id = ev.dataTransfer.getData("id");
  remove(id);
  var token = $("#uploadMockup input[name='_token']");

  var data = "_method=DELETE&_token="+token.val()+"&mockupId="+id;
  $.ajax({
    url : del_image_route,
    type : 'POST',
    data : data
  })
}

/**
* Change color on focus and load the linked image to the step clicked
*/
$('.scenario .tableRow').click(function(){
  $('.scenario .tableRow.active').removeClass('active');
  $(this).addClass('active');

  if(typeof this.mockupUrl !== 'undefined' && this.mockupUrl.value != '')
    var mockupUrl = this.mockupUrl.value;
  else{
    var getUrl = window.location;
    var mockupUrl = getUrl .protocol + "//" + getUrl.host +'/mockups/thumbnail-default.jpg';
  }

  $('.maquette img').attr('src', mockupUrl);
});

/**
* Reset Step bakground color
*/
function resetStepColor(element){
  $(element).css('border-width','1px');
  $(element).css('border-color', '#ccc');
}

/**
* Auto save the step on leave if modified
*/
function updateStep(form, element){
  if(form.oldReponse.value != form.reponse.value || form.oldAction.value != form.action.value){
    $.ajax({
      url : $(form).attr('action'),
      type : $(form).attr('method'),
      data : $(form).serialize(),
      success : function(){
        form.oldReponse.value = form.reponse.value;
        form.oldAction.value = form.action.value;
        $(element).css('border-width','2px');
        $(element).css('border-color', 'green');
      }
    })
  }
}
