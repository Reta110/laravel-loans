<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Loan;
use App\Policies\ActivityPolicy;
use App\Policies\LoanPolicy;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Activity::class => ActivityPolicy::class,
        Loan::class => LoanPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Client or Admin
        Gate::define('advanced', function ($user) {
            return $user->role != 'user';
        });

        //Just admins
        Gate::define('advancedActions', function ($user) {
            return $user->role == 'admin';
        });
    }
}
