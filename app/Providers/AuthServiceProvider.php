<?php

namespace App\Providers;

use Gate;
use Laravel\Passport\Passport; 
use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      //  dd('test');
        $this->registerPolicies();
        //Passport::routes(); 

        Gate::define('isAdmin',function($user){
              return $user->role == 'admin';
        });

        Gate::define('isEmployee',function($user){
            return $user->role == 'employee';
        });
        
        Gate::define('isManager',function($user){
            return $user->role == 'manager';
        });

        //
    }
}
