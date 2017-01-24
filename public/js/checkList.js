/*
    Created By: Fabio Marques
    Description: Functions to handle checkLists
*/
$(document).ready(function () {
  // Add a new item on checkList
  $('.addCheckList').click(function () {
      var id = this.getAttribute('data-id');
      var baseUrl = this.getAttribute('data-URL');
      $.get(baseUrl+"/checkList/"+id+"/create", {}, function (form) {
          bootbox.dialog({
              title: "Insérer un nouvel élément",
              message: form
          });
          //$('#taskdetail').html(task);
      });
  });

  //switch view button hidde or not the completed items
  $('.changeView').click(function(){
    var parent = $(this).parent();
    parent.children('.completed').toggleClass('hidden');
    parent.children('.changeView').toggleClass('hidden');
  });
});
