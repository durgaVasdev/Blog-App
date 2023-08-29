<?php

namespace App\Providers;



use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function ($view) {
            $hasPermissions = false; // Default to false

            // Logic to check if any role has any permission
            // You'll need to implement this logic using your roles and permissions setup
            // For example, using a package like Spatie's Laravel Permission
            // $hasPermissions = ...;

            $view->with('hasPermissions', $hasPermissions);
        });
    }
}
