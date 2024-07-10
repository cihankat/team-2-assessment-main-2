<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\CompletedUserstory;
use App\Models\Notification;
use App\Models\User;
use App\Models\Userstory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserstoryController extends Controller
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
    public function create(Checklist $checklist)
{
    // Haal de userstories op die behoren tot de specifieke checklist
    $userstories = Userstory::where('checklist_id', $checklist->id)->get();

    return view('userstories.create', compact('checklist', 'userstories'));
}


    /**
     * Store a newly created resource in storage.
     */

         public function store(Request $request, Checklist $checklist)
    {
        $userstory = new Userstory();
        $userstory->description = $request->description;
        $userstory->checklist_id = $request->checklist_id;
        $userstory->save();

        return redirect()->route('checklists.index', $checklist->id);
    }


public function saveCompletedUserstories(Request $request,Checklist $checklist)
    {
        $user = Auth::user();
        if ($request->has('action')) {
            if ($request->input('action') === 'save') {

        $request->validate([
            'userstories' => 'required|array',
            'userstories.*' => 'exists:userstories,id',
        ]);

        foreach ($request->userstories as $userstoryId) {

            $completedUserstory = CompletedUserstory::where('user_id', $user->id)
                                                    ->where('userstory_id', $userstoryId)
                                                    ->first();
            if (!$completedUserstory) {
                $completedUserstory = new CompletedUserstory();
                $completedUserstory->user_id = $user->id;
                $completedUserstory->userstory_id = $userstoryId;
                $completedUserstory->save();
            }

        }
        return redirect()->back()->with('success', 'Userstories opgeslagen.');
    }
    elseif ($request->input('action') === 'send') {
        $assessmentId = $checklist->assessment_id;
        $checklistName =$checklist->title;
        $userId = DB::table('assessments_users')
            ->where('assessment_id', $assessmentId)
            ->value('user_id');
        $userName = User::find($user->id)->firstname;

        Notification::create([
            'title' => "Checklist afgemaakt.",
            'message' =>  $userName . " heeft de checklist ". $checklistName ." afgemaakt.",
            'user_id' =>$userId

        ]);
    }

        return redirect()->back()->with('success', 'Userstories opgeslagen.');

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