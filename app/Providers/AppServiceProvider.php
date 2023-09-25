<?php

namespace App\Providers;

use App\Contracts\Category\CategoryRepositoryContract;
use App\Contracts\Category\CategoryServiceContract;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryServiceContract::class, CategoryService::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
