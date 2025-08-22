<?php

namespace App\Providers;

use App\Interfaces\UserProfileRepositoryInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
