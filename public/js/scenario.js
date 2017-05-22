function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("url", ev.target.src);
    ev.dataTransfer.setData("id", ev.target.id);
}

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

$('.scenario .tableRow').click(function(){
  $('.scenario .tableRow.active').removeClass('active');
  $(this).addClass('active');

  if(typeof this.mockupUrl !== 'undefined')
    var mockupUrl = this.mockupUrl.value;
  else{
    var getUrl = window.location;
    var mockupUrl = getUrl .protocol + "//" + getUrl.host +'/mockups/thumbnail-default.jpg';
  }

  $('.maquette img').attr('src', mockupUrl);
});
