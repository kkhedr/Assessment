<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Blog\{BlogRepositoryInterface, BlogRepository};
use App\Repository\Auth\{AuthRepositoryInterface, AuthRepository};
use App\Repository\User\{UserRepositoryInterface, UserRepository};
use App\Repository\Role\{RoleRepositoryInterface, RoleRepository};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
