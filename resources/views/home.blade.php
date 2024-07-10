@extends('components.layouts.user')

@section('title', 'Home')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Calendar Overview</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-5 flex" style="max-width: 80%;">
        <div class="w-2/3">
            <h2 class="text-center mb-5 border-b-2 pb-3 text-2xl font-semibold">Kalender Overzicht</h2>
            <div id="calendar" class="bg-white p-4 rounded shadow"></div>
        </div>
        <div class="w-1/3 ml-5">
            <h2 class="text-center mb-5 border-b-2 pb-3 text-2xl font-semibold">Recent Assessments</h2>
            <ul class="bg-white p-4 rounded shadow mb-5">
                @foreach($recentAssessments as $assessment)
                    <li class="mb-2">
                        <h3 class="text-lg font-semibold">{{ $assessment->title }}</h3>
                        <p class="text-gray-600">{{ $assessment->description }}</p>
                        <small class="text-gray-500">Created at: {{ $assessment->created_at }}</small>
                    </li>
                @endforeach
            </ul>
            <h2 class="text-center mb-5 border-b-2 pb-3 text-2xl font-semibold">Recent Checklists</h2>
            <ul class="bg-white p-4 rounded shadow">
                @foreach($recentChecklists as $checklist)
                    <li class="mb-2">
                        <h3 class="text-lg font-semibold">{{ $checklist->title }}</h3>
                        <small class="text-gray-500">Created at: {{ $checklist->created_at }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var appointment = @json($events);
            console.log(appointment); // Debug to check the format of events
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: appointment,
                selectable: false, // Disable selection
                editable: false, // Disable event dragging and resizing
                eventClick: function(event) {
                    // Optionally, you can add code here to display event details in a modal or alert
                    alert('Event: ' + event.title + '\nStart: ' + moment(event.start).format('YYYY-MM-DD HH:mm') + '\nEnd: ' + moment(event.end).format('YYYY-MM-DD HH:mm') + '\nComments: ' + event.comments);
                }
            });
        });
    </script>
</body>
@endsection
