<?php

namespace App\Providers;

use App\Events\AppointmentCreated;
use App\Listeners\SendAppointmentCreatedNotification;
use App\Models\Post;
use App\Models\User;
use App\Policies\AdminRolPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('develop', function ($user) {
            return $user->hasRole('develop');
        });

        Gate::define('admin', function ($user) {
            return $user->hasRole(['develop', 'admin']);
        });

        Gate::define('professional', function ($user) {
            return $user->hasRole(['appointment']);
        });
    }
}