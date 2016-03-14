<?php

namespace Siged\Providers;

use Illuminate\Support\ServiceProvider;
use Siged\Infraestructura\Usuarios\UsuariosRepositorioLaravelSQLServer;

class UsuariosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siged\Infraestructura\Usuarios\UsuariosRepositorioInterface', function($app) {
            return new UsuariosRepositorioLaravelSQLServer();
        });
    }
}
