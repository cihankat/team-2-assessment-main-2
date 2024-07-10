<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user ? $user->notifications()->latest()->get() : [];

        return view('notifications.notifications', ['notifications' => $notifications]);
    }

    public function showNotification($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->markAsRead();

            return view('notifications.notification', ['notification' => $notification]);
        } else {
            abort(404);
        }
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->markAsRead();

            return redirect()->back()->with('success', 'Gemarkeerd als gelezen');
        } else {
            return redirect()->back()->with('error', 'Niet gevonden.');
        }
    }

    public function markAsUnread($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->read_at = null;
            $notification->save();

            return redirect()->route('notifications')->with('success', 'Niet gelezen');
        } else {
            return redirect()->back()->with('error', 'Deze pagina is niet gevonden');
        }
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        if ($user) {
            $unreadNotifications = $user->notifications()->whereNull('read_at')->get();

            foreach ($unreadNotifications as $notification) {
                $notification->markAsRead();
            }

            return redirect()->back()->with('success', 'Alle notificaties zijn gemarkeerd als bekeken.');
        } else {
            return redirect()->back()->with('error', 'Je moet ingelogd zijn.');
        }
    }
}
