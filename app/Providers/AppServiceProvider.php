<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Retrieve unread notification count for the user
        View::composer('components.layouts.user', function ($view) {
            $unreadNotificationCount = 0;

            $user = Auth::user();
            if ($user) {
                $unreadNotificationCount = $user->notifications()->whereNull('read_at')->count();
            }

            // Pass the unread notification count to the view
            $view->with('unreadNotificationCount', $unreadNotificationCount);
        });

        View::composer(['components.layouts.user', 'dashboard'], function ($view) {
            $user = Auth::user();
            $notifications = $user ? $user->notifications()->latest()->limit(5)->get() : [];

            $view->with('notifications', $notifications);
        });
    }
}
