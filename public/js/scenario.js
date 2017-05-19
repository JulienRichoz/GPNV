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

    var row = document.querySelector('tr.active');
}

$('.scenario tr').click(function(){
  $('.scenario tr.active').removeClass('active');
  $(this).addClass('active');
  var mockupUrl = this.children[0].mockupUrl.value;
  if(mockupUrl != '')
    mockupUrl = 'mockups/thumbnail-default.jpg';
    $('.maquette img').attr('src', mockupUrl);
});
