<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /*
    root
    admin
    editor
    moder
    user
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isRoot', function(User $user){
            return $user->type == 'root';
        });

        Gate::define('isAdmin', function (User $user) {
            return ($user->type == 'root' || $user->type == 'admin');
        });

        Gate::define('isEditor', function (User $user) {
            return ($user->type == 'root' || $user->type == 'admin' || $user->type == 'editor');
        });

        Gate::define('isModer', function (User $user) {
            return ($user->type == 'root' || $user->type == 'admin' || $user->type == 'moder');
        });
    }
}
