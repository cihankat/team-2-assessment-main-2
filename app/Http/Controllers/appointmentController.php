<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\StudentCalendar;
use App\Models\TeacherCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'start_time' => 'required|date',
                'finish_time' => 'required|date',
                'comments' => 'nullable|string',
            ]);

            // Save the appointment
            $appointment = new Appointment();
            $appointment->title = $request->title;
            $appointment->start_time = $request->start_time;
            $appointment->finish_time = $request->finish_time;
            $appointment->comments = $request->comments; // Use the correct column name
            $appointment->save();

            // Return a success response
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Er is een fout opgetreden: ' . $e->getMessage());
            return response()->json(['error' => 'Er is een fout opgetreden tijdens het opslaan van de afspraak.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
