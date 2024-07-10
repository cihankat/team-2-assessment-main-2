@extends('components.layouts.user')

@section('title', 'Calendar')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-5" style="max-width: 70%;">
        <h2 class="text-center mb-5 border-b-2 pb-3 text-2xl font-semibold">Kalender</h2>
        <div id="calendar" class="bg-white p-4 rounded shadow"></div>
    </div>

    <!-- Modal -->
    <div id="appointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h1 class="text-lg leading-6 font-medium text-gray-900">Maak een nieuwe afspraak</h1>
                        <div class="mt-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            <label for="start_time" class="block text-sm font-medium text-gray-700 mt-2">Start tijd</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            <label for="finish_time" class="block text-sm font-medium text-gray-700 mt-2">Eind tijd</label>
                            <input type="datetime-local" name="finish_time" id="finish_time" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            <label for="comments" class="block text-sm font-medium text-gray-700 mt-2">Opmerking</label>
                            <textarea name="comments" id="comments" cols="30" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="saveBtn" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Opslaan
                </button>
                <button id="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Sluiten
                </button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var appointment = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: appointment,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    $('#appointmentModal').removeClass('hidden');
                    $('#saveBtn').off('click').on('click', function() {
                        var title = $('#title').val();
                        var start_time = $('#start_time').val();
                        var finish_time = $('#finish_time').val();
                        var comments = $('#comments').val();

                        // Send data to backend for saving
                        $.ajax({
                            url: '{{ route('appointment.store') }}',
                            type: 'POST',
                            data: {
                                title: title,
                                start_time: start_time,
                                finish_time: finish_time,
                                comments: comments,
                                _token: '{{ csrf_token() }}' // CSRF token for security
                            },
                            success: function(response) {
                                // Add the new event to the calendar
                                $('#calendar').fullCalendar('renderEvent', {
                                    title: title,
                                    start: start_time,
                                    end: finish_time
                                }, true);

                                // Close the modal
                                $('#appointmentModal').addClass('hidden');
                                // Optionally, you can clear the form fields here
                                $('#title').val('');
                                $('#start_time').val('');
                                $('#finish_time').val('');
                                $('#comments').val('');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error saving appointment:', xhr.responseText);
                                alert('An error occurred while saving the appointment. Please check the console for more details.');
                            }
                        });
                    });
                }
            });

            $('#closeModal').click(function() {
                $('#appointmentModal').addClass('hidden');
            });
        });
    </script>
</body>
@endsection
