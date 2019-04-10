<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        $this->registerPolicies();

        Gate::define('edit-time', function($user){
            return $user->level === 3;
        });

        // Gate::define('giaovien', function($user){
        //     return $user->level === 2;
        // });

        // Gate::define('thuky', function($user){
        //     return $user->level === 1;
        // });

        Gate::define('dangkydetai', function($user){
            return $user->level === 0;
        });
    }
}
