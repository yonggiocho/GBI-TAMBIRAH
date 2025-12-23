<?php

namespace App\Providers;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Identitas;
use App\Models\Banner;


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
        Paginator::useBootstrapFive();
        Paginator::defaultView('vendor.pagination.custom-pagination');


        $identitas = Identitas::first();
        $banner = Banner::first();


        if (Schema::hasTable('identitas')) {
            View::share([
                'identitas' => $identitas,
                'banner'    => $banner,
            ]);
        }

        RateLimiter::for('login', function (Request $request) {
        $email = (string) $request->input('email');
            return [
                // Maksimum 5 percobaan per 15 menit per email+IP
                Limit::perMinutes(15, 5)->by($email.$request->ip()),
            ];
        });

    }
}
