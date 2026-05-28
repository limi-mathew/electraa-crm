<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Eloquent\CustomerRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::addNamespace('mail', resource_path('views/vendor/mail'));
        Gate::policy(Invoice::class, InvoicePolicy::class);

    }
}
