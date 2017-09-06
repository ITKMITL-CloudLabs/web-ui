<?php

namespace App\Providers;

use App\Authentication\KeystoneGuard;
use App\Authentication\KeystoneUserProvider;
use Illuminate\Support\Facades\Auth;
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

        Auth::extend('keystone', function($app) {
            return new KeystoneGuard(
                'keystone',
                new KeystoneUserProvider(),
                $app->make('session.store'),
                $app->make('request')
            );
        });
    }
}
