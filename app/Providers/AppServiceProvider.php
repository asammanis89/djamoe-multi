<?php

namespace App\Providers; // <--- INI HARUS DI ATAS

use Illuminate\Support\Facades\URL; // <--- PINDAH KE SINI
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
        //
    }
}
