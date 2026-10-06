<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('create_product',function(User $user){
         return $user->is_admin;
        });
        
        Gate::define('create_category',function(User $user){
         return $user->is_admin;
        });

        Gate::define('show_orders',function(User $user){
         return $user->is_admin;
        });
    }
}
