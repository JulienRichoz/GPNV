/*
  Created By: Raphaël Bazzari
  Last modification by: Raphaël B. on 20.05.2017
  Description: Handles tasks filters behaviour
*/

$(document).ready(function () {
  // ------------------------------ Event handling ------------------------------
  // Displaying the task list whenever the user clicks a new filter checkbox
  $(".checkboxFilter").change(function() {
    // Cookie management
    var checkbox = $(this);
    var cookieName = "#" + checkbox.attr("id")
    setCookie(cookieName, checkbox.is(":checked"), document.location.pathname);
    // console.log("saving:\n" + cookieName + " " + checkbox.is(":checked") + " @ " + document.location.pathname);

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
    // console.log("saving:\n" + cookieName + " " + listItemIndex + " @ " + document.location.pathname);

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
    // console.log("saving:\n" + cookieName + " " + listItemIndex + " @ " + document.location.pathname);

    refreshDisplayedTasks();
  });


  // ------------------------------ Initialization handling ------------------------------
  // Filling the task list when the browser loads the page
  refreshDisplayedTasks();
});