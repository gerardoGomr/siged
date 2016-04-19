<?php
namespace Siged\Infraestructura\Documentos\Contratos;

use Siged\Dominio\Documentos\OficioExterno;
use Siged\Infraestructura\Contratos\RepositorioInterface;

/**
 * Interface OficiosExternosRepositorioInterface
 * @package Siged\Infraestructura\Documentos\Contratos
 * @author Gerardo Adrián Gómez Ruiz
 */
interface OficiosExternosRepositorioInterface extends RepositorioInterface
{
    /**
     * guardar
     * @param OficioExterno|Momento $oficio
     * @return bool
     */
    public function guardar(OficioExterno $oficio);

    /**
     * guardar los cambios de la asignacion de oficios
     * @param OficioExterno $oficio
     * @return bool
     */
    public function guardarAsignacion(OficioExterno $oficio);
}