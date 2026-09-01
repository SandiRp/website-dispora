<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Visitor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengirim data statistik ke semua file view (blade)
        View::composer('*', function ($view) {
            $view->with('today_visitors', Visitor::where('visit_date', now()->toDateString())->count());
            $view->with('total_visitors', Visitor::count());
        });
    }
}
