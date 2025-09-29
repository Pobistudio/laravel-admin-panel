<?php

namespace App\Providers;

use App\Services\contracts\AuthService;
use App\Services\Contracts\RoleService;
use App\Services\Contracts\StatusService;
use App\Services\Contracts\UserService;
use App\Services\impls\AuthServiceImpl;
use App\Services\impls\RoleServiceImpl;
use App\Services\impls\StatusServiceImpl;
use App\Services\impls\UserServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(RoleService::class, RoleServiceImpl::class);
        $this->app->bind(StatusService::class, StatusServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
