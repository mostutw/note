<?php

namespace App\Providers;

use App\User;
use App\Maintain;
use App\Policies\MaintainPolicy;
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
        Maintain::class  => MaintainPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 系統管理者 Gate 規則
        Gate::define('isAdmin', function ($user) {
            return $user->role == User::ROLE_ADMIN;
        });

        // 一般管理者 Gate 規則
        Gate::define('isManager', function ($user) {
            return $user->role == User::ROLE_MANAGER;
        });

        // 一般使用者 Gate 規則
        Gate::define('isUser', function ($user) {
            return $user->role == User::ROLE_USER;
        });

        /**
         * 定義 user menu 權限
         */
        Gate::define('user.menu', function ($user) {
            return ($user->role == User::ROLE_ADMIN || $user->role == User::ROLE_MANAGER) ?: collect(json_decode($user->permission, true))->contains("user.menu");
        });

        /**
         * 定義 maintain menu 權限
         */
        Gate::define('maintain.menu', function ($user) {
            return ($user->role == User::ROLE_ADMIN || $user->role == User::ROLE_MANAGER) ?: collect(json_decode($user->permission, true))->contains("maintain.menu");
        });

        /**
         * 定義 resume menu 權限
         */
        Gate::define('resume.menu', function ($user) {
            return ($user->role == User::ROLE_ADMIN || $user->role == User::ROLE_MANAGER) ?: collect(json_decode($user->permission, true))->contains("resume.menu");
        });

        /**
         * 定義 flow menu 權限
         */
        Gate::define('flow.menu', function ($user) {
            return ($user->role == User::ROLE_ADMIN || $user->role == User::ROLE_MANAGER) ?: collect(json_decode($user->permission, true))->contains("flow.menu");
        });
    }
}
