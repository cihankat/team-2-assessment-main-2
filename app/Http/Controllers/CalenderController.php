<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    /**
     * Handle the incoming request.
     */


     public function index()
    {
        $appointments= Appointment::all();
        $events = [];
        foreach($appointments as $appointment){
            $events[] = [
                'title' => $appointment-> title,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
                'comment' => $appointment->comments ,
                'classroom' => $appointment->classroom_id,
                'teacher' => $appointment->teacher_id,

            ];
        }

        return view('calendar',['events'=>$events]);
    }
    // public function __invoke(Request $request)
    // {
    //     $events = [];

    //     // Now that Appointment is imported, this should work without error
    //     $appointments = Appointment::with(['Student', 'Teacher'])->get();

    //     foreach ($appointments as $appointment) {
    //         $events[] = [
    //             'title' => $appointment->Student->name . ' (' . $appointment->Teacher->name . ')',
    //             'start' => $appointment->start_time,
    //             'end' => $appointment->finish_time,
    //         ];
    //     }

    //     return view('calendar1', compact('events'));
    // }
}