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
        'App\Model'         => 'App\Policies\ModelPolicy',
        'App\User'          => 'App\Policies\UserPolicy',
        'App\Role'          => 'App\Policies\RolePolicy',
        'App\Org'           => 'App\Policies\OrgPolicy',
        'App\Setting'       => 'App\Policies\SettingPolicy',
        'App\Eula'          => 'App\Policies\EulaPolicy',
        'App\Audit'         => 'App\Policies\AuditPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
