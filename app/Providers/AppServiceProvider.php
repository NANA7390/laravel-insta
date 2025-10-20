<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\URL;


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
        //formatting page links
        Paginator::useBootstrap();

        //create the ''admin'' gate
        Gate::define('admin', function ($user) {
            return $user->role_id == User::ADMIN_ROLE_ID;
        });


        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
