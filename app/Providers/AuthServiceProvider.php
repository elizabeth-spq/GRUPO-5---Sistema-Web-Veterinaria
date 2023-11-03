<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('administrador', function ($user) {
            return $user->hasRole('administrador');
        });

        Gate::define('veterinario', function ($user) {
            return $user->hasRole('veterinario');
        });

        Gate::define('recepcionista', function ($user) {
            return $user->hasRole('recepcionista');
        });

        Gate::define('crear', function ($user) {
            return $user->hasAnyRole(['administrador', 'recepcionista']);
        });

        Gate::define('editar', function ($user) {
            return $user->hasAnyRole(['administrador', 'recepcionista']);
        });

        Gate::define('eliminar', function ($user) {
            return $user->hasRole('administrador');
        });
        /*
        Gate::before(function ($user, $ability) {
            if ($user->hasPermission('administrador')) {
                return true;
            }
        });
        Gate::define('crear-cliente', function ($user) {
            return $user->hasPermission('editar-cliente');
        });

        Gate::define('editar-cliente', function ($user) {
            return $user->hasPermission('editar-cliente');
        });

        Gate::define('eliminar-cliente', function ($user) {
            return $user->hasPermission('eliminar-cliente');
        });

        Gate::define('editar-mascota', function ($user) {
            return $user->hasPermission('editar-mascota');
        });

        Gate::define('eliminar-mascota', function ($user) {
            return $user->hasPermission('eliminar-mascota');
        });

        */
    }
}
