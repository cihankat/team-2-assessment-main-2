<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateNotificationController extends Controller
{
    public function index() {
        Notification::create([
            'title' => 'Test',
            'message' => "Dit is een test",
            'user_id' => Auth::id()
        ]);

        return redirect()->route('home');
}
}
