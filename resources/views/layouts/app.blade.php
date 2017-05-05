<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>GPNV</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/template.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/project.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/logBook.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/awesome-bootstrap-checkbox.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/checkList.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/scenario.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('js/summernote-0.8.2/summernote.css') }}">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top ">
    <div class="container">
        <div class="navbar-header">


            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                GPNV <div class="version"><?=getGitLastTag(); ?></div>
            </a>
        </div>

        <div class="collapse navbar-collapse " id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <!-- Authentication Links -->
            @if (Auth::user())
                <ul class="nav navbar-nav">
                    @if (Auth::user()->role->id == 2)
                      <li><a>|</a></li>
                      <li><a href="{{ url('/admin') }}">Admin</a></li>
                    @endif

                </ul>

                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/project/create') }}">Nouveau projet</a></li>
                </ul>

                {{-- Takes the Route name and show the apropriate menu --}}
                @if(Route::current() ->getName() === 'project.show')
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Tous les projets</a></li>
                    </ul>
                    @endif

                    @endif

                            <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>

                        @else
                            <li><a href="{{route('user.show', Auth::user()->id)}}">{{Auth::user()->fullname}}</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
        </div>
    </div>
</nav>
<input type="hidden" name="_token" value="{{ csrf_token() }}">


@yield('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ URL::asset('js/jquery.ntm.js') }}"></script>
<script src="{{ URL::asset('js/bootbox.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ URL::asset('js/checkList.js') }}"></script>
<script src="{{ URL::asset('js/scenario.js') }}"></script>
<script src="{{ URL::asset('js/objectifs.js') }}"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ URL::asset('js/scripts.js') }}"></script>
<script src="{{ URL::asset('js/summernote-0.8.2/summernote.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(document).ready(function () {
        $('.tree-menu').ntm();
    });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        // Displays details of a given task
        $('#app-layout').on('click', '.taskshow', function () {
            console.log(this);
            var task = this.getAttribute('data-id');
            $.get("{{ url('tasks') }}/" + task, {}, function (task) {
                // console.log(task);
                $('#taskdetail').html(task);
            });

            $.get('', function (task) {
                //console.log(task);
            });
        });

        // Add student user to project
        $('a.addStudents').click(function () {
            var projectid = this.getAttribute('data-projectid');
            $.get("{{ url('project') }}/" + projectid + "/getStudents", function (projectid) {
                bootbox.dialog({
                    title: "Ajouter un élève de la classe",
                    message: projectid
                });
            });
        });

        // Add teacher user to project
        $('a.addTeachers').click(function () {
            var projectid = this.getAttribute('data-projectid');
            $.get("{{ url('project') }}/" + projectid + "/getTeachers", function (projectid) {
                bootbox.dialog({
                    title: "Ajouter un enseignant",
                    message: projectid
                });
            });
        });

        $('a.quitProject').click(function () {
            var projectid = this.getAttribute('data-projectid');
            var userid = this.getAttribute('data-id');

              bootbox.confirm({
                title: "Voulez-vous quitter le projet ?",
                message: "Cette action vous retirera du projet, cette action ne peut être annulée.<br/> Vos tâches attribuées resteront mais ne vous seront plus attribuées. (Les autres membres seront informés des changements)",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Retour',
                        className: 'btn-success'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Quitter le projet',
                        className: 'btn-danger'
                    }
                },
                callback: function(result){
                    if (result) {
                        $.ajax({
                            url: "{{ url('project') }}/" + projectid + "/removeFromProject/" + userid,
                            type: "POST",
                            success: function() {
                                bootbox.alert("Projet quitté avec succés.");
                                location.reload();
                            },
                            error: function() {
                                console.log(result);
                            }
                        });
                    }
                }
            });
        });

        $('button.removeUser').click(function () {
            var projectid = this.getAttribute('data-projectid');
            var userid = this.getAttribute('data-id');

            bootbox.confirm({
              title: "Voulez-vous vraiment supprimer cet utilisateur ?",
              message: "Cette action le retirera du projet, cette action ne peut être annulée.<br/> Les tâches attribuées $ l'utilisateur resteront mais ne vous seront plus attribuées. (Les autres membres seront informés des changements)",
              buttons: {
                  cancel: {
                      label: '<i class="fa fa-times"></i> Retour',
                      className: 'btn-success'
                  },
                  confirm: {
                      label: '<i class="fa fa-check"></i> Supprimer du projet',
                      className: 'btn-danger'
                  }
              },
              callback: function(result){
                  if (result) {
                      $.ajax({
                          url: "{{ url('project') }}/" + projectid + "/removeFromProject/" + userid,
                          type: "POST",
                          success: function() {
                              bootbox.alert("Utilisateur supprimé avec succés.");
                          },
                          error: function() {
                              console.log(result);
                          }
                      });
                  }
              }
          });
        });

        // Edit a task
        $('#app-layout').on('click', 'button.taskedit', function () {
            var task = this.getAttribute('data-id');
            $.get("{{ route('tasks.edit', '@') }}".replace('@', task), {}, function (task) {
                bootbox.dialog({
                    title: "Editer une tâche",
                    message: task
                });
            });
        });

        // Add a parent task
        $('#app-layout').on('click', 'button.taskplus', function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('tasks') }}/" + task + "/children/create", {}, function (task) {
                bootbox.dialog({
                    title: "Créer une tâche enfant",
                    message: task
                });
            });
        });

        // Add a root task
        $('#app-layout').on('click', '.taskroot', function () {
            var task = this.getAttribute('data-id');
            $.get("{{ url('project') }}/" + task + "/tasks/create", {}, function (task) {
                bootbox.dialog({
                    title: "Créer une tâche racine",
                    message: task
                });
                //$('#taskdetail').html(task);
            });
        });

        // Return the view to add a user for a task
        $('#app-layout').on('click', 'a.events', function () {
            var projectId = this.getAttribute('data-id');
            bootbox.prompt({
                size: "large",
                backdrop: true,
                title: "Insérez un évènement",
                inputType: 'textarea',
                callback: function(result){
                    if (result != null) {
                        if (result != "") {
                            $.ajax({
                                url: "{{ route('project.storeEvents', '@') }}".replace('@', projectId),
                                type: 'post',
                                data: { description: result },
                                success: function() {
                                    if (result != null) {
                                        callEvents(projectId);
                                        displayConfirmation(true);
                                    }
                                },
                                error: function() {
                                    displayConfirmation(false);
                                }
                            });
                        } else {
                            bootbox.alert("La description d'un évènement ne peut pas être vide");
                        }
                    }
                }
            });
        });

        // Call a view to add a user for a task
        $('#app-layout').on('click', 'button.taskuser', function () {
            var task = this.getAttribute('data-id');
            $.ajax({
                url: "{{ route('tasks.users', '@') }}".replace('@', task),
                type: 'get',
                success: function (data) {
                    bootbox.dialog({
                        title: "Gestion des utilisateurs de la tâche",
                        message: data
                    });

                }
            });
        });

        // Delete a task
        $('#app-layout').on('click', 'button.taskdestroy', function () {
            var task = this.getAttribute('data-id');
            bootbox.confirm("Vous allez supprimer cette tâches ? ", function (result) {
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('tasks') }}/" + task,
                        data: task,
                        success: function (task) {
                            location.reload();
                        },
                        error: function (task) {
                            location.reload();
                        }
                    });
                }
            });

        });

        // Delete user of project
        $('button.userprojectdestroy').click(function () {
            var id = this.getAttribute('data-id');
            var projectid = this.getAttribute('data-projectid');
            bootbox.confirm("Voulez vous vraiment retirer l'utilisateur du projet ? ", function (result) {
                //Example.show("Confirm result: "+result);
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('project') }}/" + projectid + "/users/" + id + "/destroy",
                        success: function (data) {
                            //alert(data);
                            bootbox.alert("Element supprimer avec succès");
                            $('#taskdetail').html(data);
                        }
                    });
                }
            });

        });

        // Add a target
        $('#app-layout').on('click', 'a.target', function () {
            var projectid = this.getAttribute('data-projectid');
            $.ajax({
                url: "{{ route('project.gettarget', '@') }}".replace('@', projectid),
                type: 'get',
                success: function (data) {
                    bootbox.dialog({
                        title: "Ajouter un objectif",
                        message: data
                    });
                }
            });
        });

        // Begin a rush for a task
        $('#app-layout').on('click', 'button.taskplay', function () {
            var usertaskid = this.getAttribute('data-usertaskid');
            $.ajax({
                url: "{{ route('tasks.play', '@') }}".replace('@', usertaskid),
                type: 'post',
                success: function (data) {

                    if (data == "") {
                        bootbox.dialog({
                            title: "debug",
                            message: "Tache déja en cours"
                        });
                    } else {
                        var button = $('button[data-usertaskid=' + usertaskid + ']');
                        $(button).children().removeClass();
                        button.children().addClass("glyphicon glyphicon-stop");
                        button.removeClass();
                        button.addClass("right btn taskstop btn-lg");
                        button.attr("data-duration", data);
                    }
                }
            });
        });

        // Stop a rush for a task
        $('#app-layout').on('click', 'button.taskstop', function () {
            var duration = this.getAttribute('data-duration');
            $.ajax({
                url: "{{ route('tasks.stop', '@') }}".replace('@', duration),
                type: 'post',
                success: function (data) {
                    var button = $('button[data-duration=' + duration + ']');
                    $(button).children().removeClass();
                    button.children().addClass("glyphicon glyphicon-play-circle");
                    button.removeClass();
                    button.addClass("right btn taskplay btn-lg");

                }
            });
        });

        function callEvents(project) {
            $.ajax({
                url: "{{ route('project.events', '@') }}".replace('@', project),
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var currentUserId = data.currentUser.id;
                    var members = data.members;
                    var validations = data.validations;
                    var badgeCount = data.badgeCount;
                    var content = ("<table class='table'><thead><tr><th>Qui</th><th>Quand</th><th>Quoi</th><th>Vu</th></tr></thead>");

                    $.each(data.eventInfos, function () {
                        var eventId = this.eventId;

                        // Basic opening row tag
                        var openingRowTag = "<tr data-eventId=\"" + eventId + "\">";

                        // Displaying / hiding the row according to the checkbox status and the currently logged user
                        if (currentUserId == this.userId) {
                            openingRowTag = "<tr class=\"userMade\" data-eventId=\"" + eventId + "\">";
                            if (!$('#toggleUserEntries').prop( "checked" )) {
                                openingRowTag = "<tr class=\"userMade hidden\" data-eventId=\"" + eventId + "\">";
                            }
                        }

                        // Formatting the date to regional format (dd.mm.yy)

                        var fetchedDate = this.created_at;
                        var date = new Date(fetchedDate);

                        var formattedDate = ('0' + date.getDate()).slice(-2) + '.'
                            + ('0' + (date.getMonth()+1)).slice(-2) + '.'
                            + date.getFullYear().toString().slice(-2)
                            + " " + ('0' + date.getHours()).slice(-2)
                            + ":" + ('0' + date.getMinutes()).slice(-2);

                        content += (openingRowTag);
                        content += ("<td>" + this.firstname + " " + this.lastname + "</td>");
                        content += ("<td>" + formattedDate + "</td>");
                        content += ("<td>" + this.description + "</td>");
                        content += ("<td>");

                        // Validation status management
                        $.each(members, function() {
                            if (this.id != currentUserId) {
                                content += ("<span title=\"" + this.firstname + " " + this.lastname
                                + "\" data-toggle=\"tooltip\" data-placement=\"bottom\">");

                                var statusClass; // indicates whether the event has been validated or not

                                // Checking whether the member has validated the event
                                if ($.inArray(this.id, validations[eventId]) > -1) {
                                    statusClass = "validEvent";
                                } else {
                                    statusClass = "invalidEvent";
                                }

                                content += ("<span class=\"glyphicon glyphicon-stop " + statusClass + "\" aria-hidden=\"true\" data-userId=\"" + this.id + "\"></span>");
                                content += ("</span>");
                            }
                        });

                        // Displaying the validation button if the user hasn't validated an entry
                        if (!($.inArray(currentUserId, validations[eventId]) > -1)) {
                            content += ("<button type=\"button\" class=\"btn btn-primary validationButton\" style=\"margin-left: 20px;\" data-userId=\"" + currentUserId + "\">Valider</button>");
                        }

                        content += ("</td>");
                        content += ("</tr>");
                    });

                    content += ("</table>");
                    $('#logbookPanel').html(content);

                    // enabling bootstrap tooltips
                    $('[data-toggle="tooltip"]').tooltip();


                    $('.validationButton').click(function() {
                        updateValidationStatus(this);
                    });

                    // updating the badge count and visibility
                    if(badgeCount > 0) {
                        if($('#logBookBadge').length == 0) {
                            var badge = "<span id=\"logBookBadge\" class=\"badge\">" + badgeCount + "</span>";
                            $("#logBookContainer h1").append(badge);
                        } else {
                            $('#logBookBadge').html(badgeCount);
                        }
                    } else {
                        $('#logBookBadge').remove();
                    }

                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        // Delete a user for a task
        $('#app-layout').on('click', 'button.usertaskdestroy', function () {
            var usertaskdestroy = this.getAttribute('data-id');
            var projectId = $('.projectTasks').data('projectid');
            bootbox.prompt({
                size: "medium",
                backdrop: true,
                title: "Insérez un commentaire",
                inputType: 'textarea',
                callback: function(result){
                    if (result != null) {
                        if (result != "") {
                            $.ajax({
                                url: "{{ route('tasks.userTaskDelete', '@') }}".replace('@', usertaskdestroy),
                                type: 'delete',
                                data: { projectId: projectId, comment: result},
                                success: function (data) {
                                    bootbox.hideAll();
                                    bootbox.dialog({
                                        title: "Suppression participant à la tâche",
                                        message: "Participant retiré de la tâche avec succès"
                                    });
                                    console.log(data);
                                },
                                error: function (data) {
                                    console.log(data);
                                }
                            });
                        } else {
                            bootbox.alert("Veuillez insérer un commentaire");
                        }
                    }
                }
            });
        });


        // Validate a task
        $('#app-layout').on('click', 'button.validate', function () {
            var taskvalidate = this.getAttribute('data-task');
            bootbox.confirm("Voulez-vous valider cette tâche ? ", function (result) {
                $.ajax({
                    url: "{{ route('tasks.status', '@') }}".replace('@', taskvalidate),
                    type: 'post',
                    success: function (data) {
                        bootbox.dialog({
                            title: "Validation de la tâche",
                            message: data
                        });
                    },
                    error: function (data) {
                        bootbox.dialog({
                            title: "Validation de la tâche",
                            message: data
                        });
                    }
                });
            });
        });

        // Validate a target
        $('#app-layout').on('click', 'button.validetarget', function () {
            var validetarget = this.getAttribute('data-targetid');
            bootbox.confirm("Voulez-vous valider cet objectif ? ", function (result) {
                $.ajax({
                    url: "{{ route('project.validetarget', '@') }}".replace('@', validetarget),
                    type: 'post',
                    success: function (data) {
                        location.reload();
                    }
                });
            });
        });

        // Delete a file
        $('#app-layout').on('click', 'button.filedestroy', function () {
            var file = this.getAttribute('data-id');
            var project = this.getAttribute('data-project');
            bootbox.confirm("Voulez-vous supprimer ce fichier ? ", function (result) {
                $.ajax({
                    url: "{{ route('files.destroy', ['@', '#']) }}".replace('@', project).replace('#', file),
                    type: 'delete',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });

        // Synchro Splash Screen
        $('a.synchro').click(function () {
            bootbox.dialog({
                    title: "Synchro Intranet",
                    closeButton: false,
                    message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Traitement en cours...</div>'
            });
        });

        // Tooltip handling (enabling bootstrap tooltips)
        $('[data-toggle="tooltip"]').tooltip();

        function updateCheckBoxStatus() {
            if ($('#toggleUserEntries').prop( "checked" )) {
                $('.userMade').removeClass("hidden");
            } else {
                $('.userMade').addClass("hidden");
            }
        }

        $('#toggleUserEntries').change(function() {
            updateCheckBoxStatus()
        });



        function displayConfirmation(success) {
            if (success) {
                bootbox.alert("L'évènement a été ajouté avec succès.");
            } else {
                bootbox.alert("Erreur. L'évènement n'a pas pu être ajouté.");
            }
        }

        function updateValidationStatus(elem) {
            var projectId = $('#logBookContainer').attr('data-projectId');
            var userId = $(elem).attr('data-userId');
            var eventId = $(elem).closest('tr').attr('data-eventId');
            /*console.log(projectId);
            console.log(userId);
            console.log(eventId);*/

            // updating the validation button appearance
            $(elem).removeClass('btn-primary');
            $(elem).addClass('btn-success');
            $(elem).html("Validé!");

            $.ajax({
                url: "{{ route('project.storeEventsValidation', '@') }}".replace('@', projectId),
                type: 'post',
                data: { userId: userId, eventId: eventId },
                success: function(data) {
                    console.log(data);
                    // updating the event list
                    callEvents(projectId);
                },
                error: function(data) {
                    console.log(data);
                    console.log("couldn't save the event validation");
                }
            });
        }

        $('.validationButton').click(function() {
            updateValidationStatus(this);
        });



        // Init
        // Coping with the fact some browsers preserves the checkbox status after reloading pages
        updateCheckBoxStatus(); // logbook checkboxes

        @yield('script')

    });
</script>

</body>
</html>
