/*
    Created By: Fabio Marques
    Last modification by: Raphaël B. on 17.03.2017
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
    parent.children('.completed').toggleClass('hidden');
    parent.children('.changeView').toggleClass('hidden');
  });

  // Displays / hides the filter controls depending on whether the task container is collapsed or not
  /*$("#taskHeading").click(function() {
    $("#filters").toggleClass("hidden");
  });*/


  // ------------------------------ Task research ------------------------------
  // Displays / hides tasks according to the active filters
  function refreshDisplayedTasks() {
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

  // ------------------------------ Event handling ------------------------------
  // Displaying the task list whenever the user clicks a new filter checkbox
  $(".checkboxFilter").change(function() {
    refreshDisplayedTasks();
  });


  // ------------------------------ Dropdown handling ------------------------------
  // Dropdown links marking
  $(".dropTaskFilter .owner li a").click(function(event) {
    event.preventDefault();

    $('#dropdownTitleOwner').html($(this).html());

    // Removing the "activeOwner" class from the previously active status checkbox
    $(".dropTaskFilter .owner li a").removeClass("activeOwner");

    // Adding the class to the newly clicked link
    $(this).addClass("activeOwner");

    refreshDisplayedTasks();
  });

  $(".dropTaskFilter .objective li a").click(function(event) {
    event.preventDefault();

    $('#dropdownTitleObjective').html($(this).html());

    // Removing the "activeOwner" class from the previously active status checkbox
    $(".dropTaskFilter .objective li a").removeClass("activeOwner");

    // Adding the class to the newly clicked link
    $(this).addClass("activeOwner");

    refreshDisplayedTasks();
  });


  // ------------------------------ Initialization handling ------------------------------
  // Filling the task list when the browser loads the page
  refreshDisplayedTasks();
});
