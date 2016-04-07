<?php

namespace Siged\Providers;

use Illuminate\Support\ServiceProvider;
use Siged\Infraestructura\Documentos\DAO\FoliosDAO;
use Siged\Infraestructura\Documentos\FoliosSQLServerRepositorio;

class FoliosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface', function() {
             return new FoliosSQLServerRepositorio(new FoliosDAO());
        });
    }
}
