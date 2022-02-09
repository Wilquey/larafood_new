<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    TenantRepositoryInterface,
    CategoryRepositoryInterface,
    TableRepositoryInterface,
    ProductRepositoryInterface
};
use App\Repositories\{
    TenantRepository,
    CategoryRepository,
    TableRepository,
    ProductRepository

};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->bind(
            TableRepositoryInterface::class,
            TableRepository::class,
        );
        
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
