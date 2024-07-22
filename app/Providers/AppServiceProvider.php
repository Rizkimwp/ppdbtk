<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $username = null;
            // Check if a user is authenticated
            if (Auth::check()) {
                // Retrieve the logged-in user's ID
                $userId = Auth::id();
                // Retrieve the name of the logged-in user
                $username = User::where('id', $userId)->value('name');
            }
            // Share the username with all views
            $view->with('username', $username);
        });
    }
    }
