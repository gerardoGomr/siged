<?php

namespace Siged\Providers;

use Illuminate\Support\ServiceProvider;
use Siged\Infraestructura\Documentos\DAO\OficiosExternosDAO;
use Siged\Infraestructura\Documentos\OficiosExternosSQLServerRepositorio;

class OficiosExternosRepositorioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Siged\Infraestructura\Documentos\Contratos\OficiosExternosRepositorioInterface', function() {
            return new OficiosExternosSQLServerRepositorio(new OficiosExternosDAO());
        });
    }
}
