<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Classrooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classrooms $classrooms)
    {
        $user = Auth::user();//ingelogde gebruiker
        if ($user->hasRole('teacher') || $user->hasRole('administrator')) {
        // Als de gebruiker een leraar is, haal dan alle assessments op
        $assessments = Assessment::all();
    } else {
        // Als de gebruiker een student is, haal dan zijn klaslokalen op
        $classrooms = $user->classrooms;

        // Haal alle assessments op die zijn gekoppeld aan de klaslokalen van de ingelogde gebruiker
        $assessments = Assessment::whereIn('classroom_id', $classrooms->pluck('id'))->get();
    }
        //$assessments = Assessment::all();
        return view('assessment.index', compact('assessments','classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Classrooms $classrooms)
    {
        $classrooms= Classrooms::all();
        return view('assessment.create', compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'classroom_id' =>'required',
        ]);

        $assessment = new Assessment();
        $assessment->title = $request->title;
        $assessment->description = $request->description;
        $assessment->classroom_id = $request->classroom_id;
        $assessment->save();

        $assessment->users()->attach(auth()->user()->id);

        return redirect('/assessment')->with('status', "Assessment is gemaakt");
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
    {
        return view('assessment.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessment $assessment)
{
    return view('assessment.edit', compact('assessment'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Assessment $assessment)
    {
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
    ]);

    $assessment->update($request->all());

    return redirect()->route('assessment.index');
}

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Assessment $assessment)
{
    // Verwijder de gerelateerde gebruikersrelaties
    $assessment->users()->detach();

    // Verwijder het assessment
    $assessment->delete();

    return redirect()->route('assessment.index');
}

}