<?php

namespace App\Providers;


use App\Models\Configuracion;
use App\Models\Costosfijos;
use Illuminate\Support\ServiceProvider;


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
        view()->composer('*', function ($view) {
            $configuracion = Configuracion::first();
            $costos = Costosfijos::get();

            $fechaActual = date('Y-m-d');

            $view->with(['configuracion' => $configuracion, 'fechaActual' => $fechaActual, 'costos' => $costos]);
        });
    }
}
