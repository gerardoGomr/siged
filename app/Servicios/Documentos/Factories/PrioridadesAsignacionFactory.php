<?php
namespace Siged\Servicios\Documentos\Factories;

use Siged\Dominio\Documentos\PrioridadAsignacion;

/**
 * Class PrioridadesAsignacionFactory
 * @package Siged\Servicios\Documentos\Factories
 * @author Gerardo Adrián Gómez Ruiz
 */
class PrioridadesAsignacionFactory
{
    /**
     * crear una instancia de prioridades
     * @param string $valor
     * @return PrioridadAsignacion
     */
    public static function crear($valor)
    {
        if ($valor === 'normal') {
            return PrioridadAsignacion::normal();
        }

        if ($valor === 'urgente') {
            return PrioridadAsignacion::urgente();
        }
    }
}