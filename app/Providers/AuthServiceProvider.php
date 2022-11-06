<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->tipo_user_id === 1;
        });

        Gate::define('director', function (User $user) {
            return $user->tipo_user_id === 2;
        });

        Gate::define('docente', function (User $user) {
            return $user->tipo_user_id === 3;
        });

        Gate::define('alumno', function (User $user) {
            return $user->tipo_user_id === 4;
        });
    }

}
