<!DOCTYPE html>
<html>
<head>
    <title>NXS ITTC | Course Calendar</title>
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            }
        });
    });
    </script>
</head>
<body>
    <h3 style="font-family: 'Bebas Neue', cursive;font-size:50px;text-align:center;">NEXUS IT TRAINING CENTER</h3>
            <h3 style="font-family: 'Bebas Neue', cursive;font-size:40px;text-align:center;">COURSES CALENDAR</h3>
    <br>
    <div class="container" style="padding-bottom: 15px;">
        <div id="calendar"></div>
        Nexus ITTC reserves the rights to change schedule, venue, instructor or even cancel a class if the need arises.
    </div>
</body>
</html>