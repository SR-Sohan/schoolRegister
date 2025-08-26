<?php

namespace App\Providers;

use App\Interfaces\ClassModuleRepositoryInterface;
use App\Interfaces\GroupModuleRepositoryInterface;
use App\Interfaces\UserProfileRepositoryInterface;
use App\Repositories\ClassModuleRepository;
use App\Repositories\GroupModuleRepository;
use App\Repositories\UserProfileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
        $this->app->bind(ClassModuleRepositoryInterface::class, ClassModuleRepository::class);
        $this->app->bind(GroupModuleRepositoryInterface::class, GroupModuleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
