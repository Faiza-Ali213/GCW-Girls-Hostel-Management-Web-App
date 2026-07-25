<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share notification data with ALL views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = Notification::unread()
                    ->forUser(Auth::id())
                    ->active()
                    ->count();
                    
                $notifications = Notification::forUser(Auth::id())
                    ->active()
                    ->latest()
                    ->limit(5)
                    ->get();
            } else {
                $unreadCount = 0;
                $notifications = collect();
            }

            $view->with([
                'unreadCount' => $unreadCount,
                'notifications' => $notifications
            ]);
        });
    }
}