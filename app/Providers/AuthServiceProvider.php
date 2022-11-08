<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
            return $user->conta === 'admin' || $user->conta === 'super_admin';
        });
        Gate::define('usuario', function (User $user) {
            return $user->conta === 'usuario_comum';
        });
        Gate::define('funcionario', function (User $user) {
            return $user->conta === 'funcionario';
        });
        Gate::define('admin_ou_funcionario', function (User $user) {
            return $user->conta === 'admin' || $user->conta === 'super_admin' || $user->conta === 'funcionario';
        });
    }
}
