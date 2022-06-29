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

        Gate::define('optometrist', function($user) {

            return intval($user->is_optometrist) === 1;

        });

        // Gate::define('adminUsers',function($user){

        //     $idCargo =  $user->id_cargo;
        //     $permissao = Permissoes::where('id_cargo','=',$idCargo)->first();

        //     return intval($permissao->createUser) === 1;
        // });
    }
}
