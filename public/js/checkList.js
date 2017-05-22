/*
    Created By: Fabio Marques
    Last modification by: Raphaël B. on 20.05.2017
    Description: Functions to handle checkLists
*/
$(document).ready(function () {
  // Add a new item on checkList
  $('.addCheckList').click(function () {
      var id = this.getAttribute('data-id');
      var productId = this.getAttribute('data-projectid');
      var baseUrl = this.getAttribute('data-URL');
      $.get(baseUrl+"/"+productId+"/checklist/"+id+"/create", {}, function (form) {
          bootbox.dialog({
              title: "Insérer un nouvel élément",
              message: form
          });
      });
  });

  //switch view button hidde or not the completed items
  $('.changeView').click(function(){
    var parent = $(this).parent();
    parent.children('.deliveriesData').children('.completed').toggleClass('hidden');
    parent.children('.deliveriesData').children('.changeView').toggleClass('hidden');
  });
});
