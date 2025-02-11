<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CakeRepositoryInterface;
use App\Interfaces\CakeUserRepositoryInterface;
use App\Repositories\CakeRepository;
use App\Repositories\CakeUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CakeRepositoryInterface::class, CakeRepository::class);
        $this->app->bind(CakeUserRepositoryInterface::class, CakeUserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
