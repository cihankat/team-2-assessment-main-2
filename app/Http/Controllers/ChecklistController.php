<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Checklist;
use App\Models\CompletedUserstory;
use App\Models\Userstory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    public function index(Assessment $assessment)
    {
        $checklists =Checklist:: all();
        return view('checklists.index', compact('checklists','assessment'));
    }
    /**
     * Display a listing of the resource.
     */
    public function create(Assessment $assessment)
    {
        return view('checklists.create', compact('assessment'));
    }


    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request, Assessment $assessment)
    {
        $checklist = new Checklist();
        $checklist->title = $request->title;
        $checklist->assessment_id = $request->assessment_id;
        $checklist->save();

        $checklist->users()->attach(auth()->user()->id);

        return redirect()->route('assessment.index', $assessment->id);
    }

    /**
     * Display the specified resource.
     */
public function show(Assessment $assessment, Checklist $checklist,CompletedUserstory $completedUserstories )
{
    $user = Auth::user();
    $completedUserstories = $user->completedUserstories()->pluck('userstory_id')->toArray();

return view('checklists.show', [
    'completedUserstories' => $completedUserstories,
    $userstories = Userstory::where('checklist_id', $checklist->id)->get()
    ],compact('checklist','userstories','assessment'));

}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessment $assessment, Checklist $checklist)
{
    return view('checklists.edit', compact('assessment', 'checklist'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessment $assessment, Checklist $checklist)
{
    $request->validate([
        'title' => 'required',
    ]);

    $checklist->update($request->all());

    return redirect()->route('checklists.index', $assessment->id);
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Assessment $assessment, Checklist $checklist)
{
    $checklist->delete();
    return redirect()->route('checklists.index', $assessment->id);
}
}