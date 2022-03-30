<?php

namespace App\Providers;

use App\Models\{
    Category,
    Client,
    Evaluation,
    Plan,
    Product,
    Table,
    Tenant
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    EvaluationObserver,
    PlanObserver,
    ProductObserver,
    TableObserver,
    TenantObserver
};
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);
        Evaluation::observe(EvaluationObserver::class);

        /**
         * Custom If Statements
         **/
        Blade::if('admin', function () {
            $user = auth()->user();

            return $user->isAdmin();
        });
    }
}
