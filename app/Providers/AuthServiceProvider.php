<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addminutes(30));
        //Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(100));

        Passport::tokensCan([
            'Administrador' => 'Usuario administrador del sistema (Orientador)',
            'Estudiante' => 'Usuarios que usarán el sistema',
        ]);
    
        Passport::setDefaultScope([
            'Estudiante'
        ]);
    }
}
