/*
    Created By: Fabio Marques
    Last modification by: Raphaël B. on 17.03.2017
    Description: Functions to handle checkLists
*/
$(document).ready(function () {
  console.log("checklist");
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
    parent.children('.completed').toggleClass('hidden');
    parent.children('.changeView').toggleClass('hidden');
  });

  // Displays / hides the filter controls depending on whether the task container is collapsed or not
  /*$("#taskHeading").click(function() {
    $("#filters").toggleClass("hidden");
  });*/


  // ------------------------------ Event handling ------------------------------
  // Displaying the task list whenever the user clicks a new filter checkbox
  $(".checkboxFilter").change(function() {
    // Cookie management
    var checkbox = $(this);
    var cookieName = "#" + checkbox.attr("id")
    setCookie(cookieName, checkbox.is(":checked"), document.location.pathname);
    console.log("saving:\n" + cookieName + " " + checkbox.is(":checked") + " @ " + document.location.pathname);

    // UI management
    refreshDisplayedTasks();
  });


  // ------------------------------ Dropdown handling ------------------------------
  // Dropdown links marking
  $(".dropTaskFilter .owner li a").click(function(event) {
    event.preventDefault();

    var currentOwner = $(this).text();

    $('#dropdownTitleOwner').html(currentOwner);

    // Removing the "activeOwner" class from the previously active status checkbox
    $(".dropTaskFilter .owner li a").removeClass("activeOwner");

    // Adding the class to the newly clicked link
    $(this).addClass("activeOwner");

    // Cookie management
    let listItemIndex = $(this).parent().index(); // index of the containing <li>

    var dropdownValue = $(this);
    var cookieName = "#" + $(this).parent("li").parent("ul").prev("button").attr("id");
    setCookie(cookieName, listItemIndex, document.location.pathname);
    console.log("saving:\n" + cookieName + " " + listItemIndex + " @ " + document.location.pathname);

    // UI management
    refreshDisplayedTasks();
  });

  $(".dropTaskFilter .objective li a").click(function(event) {
    event.preventDefault();

    var currentObjective = $(this).text();

    $('#dropdownTitleObjective').html(currentObjective);

    // Removing the "activeObjective" class from the previously active status checkbox
    $(".dropTaskFilter .objective li a").removeClass("activeObjective");

    // Adding the class to the newly clicked link
    $(this).addClass("activeObjective");

    // Cookie management
    let listItemIndex = $(this).parent().index(); // index of the containing <li>

    var dropdownValue = $(this);
    var cookieName = "#" + $(this).parent("li").parent("ul").prev("button").attr("id");
    setCookie(cookieName, listItemIndex, document.location.pathname);
    console.log("saving:\n" + cookieName + " " + listItemIndex + " @ " + document.location.pathname);

    refreshDisplayedTasks();
  });


  // ------------------------------ Initialization handling ------------------------------
  // Filling the task list when the browser loads the page
  console.log("refreshing!");
  refreshDisplayedTasks();
});
