<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define('viewany-etudiant', function (User $user) {
            return $user->role === 'admin' || $user->role === 'regisseur';
        });

        Gate::define('view-tranches', function (User $user) {
            return $user->role === 'professeur' || $user->role === 'regisseur';
        });

        Gate::define('is_admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('is_prof', function (User $user) {
            return $user->role === 'professeur';
        });

        Gate::define('is_regisseur', function (User $user) {
            return $user->role === 'regisseur';
        });

        Gate::define('is_responsable', function (User $user) {
            return $user->role === 'responsable';
        });

    }
}
