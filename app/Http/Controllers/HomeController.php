<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Assessment;
use App\Models\Checklist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with a calendar overview, recent assessments, and checklists.
     */
    public function __invoke()
    {
        // Fetch all appointments
        $appointments = Appointment::all();

        // Format events for FullCalendar
        $events = $appointments->map(function ($appointment) {
            return [
                'title' => $appointment->title,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
                'comments' => $appointment->comments
            ];
        });

        // Fetch the 5 most recent assessments
        $recentAssessments = Assessment::orderBy('created_at', 'desc')->take(5)->get();

        // Fetch the 5 most recent checklists
        $recentChecklists = Checklist::orderBy('created_at', 'desc')->take(5)->get();

        // Pass events, recent assessments, and recent checklists data to the view
        return view('home', [
            'events' => $events,
            'recentAssessments' => $recentAssessments,
            'recentChecklists' => $recentChecklists
        ]);
    }
}
