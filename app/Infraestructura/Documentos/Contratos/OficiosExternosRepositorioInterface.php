<?php
namespace Siged\Infraestructura\Documentos\Contratos;

use Siged\Dominio\Documentos\OficioExterno;
use Siged\Infraestructura\Contratos\RepositorioInterface;
use Siged\Servicios\Contratos\Momento;

/**
 * Interface OficiosExternosRepositorioInterface
 * @package Siged\Infraestructura\Documentos\Contratos
 * @author Gerardo Adrián Gómez Ruiz
 */
interface OficiosExternosRepositorioInterface extends RepositorioInterface
{
    /**
     * guardar
     * @param Momento $oficio
     * @return mixed
     */
    public function guardar(Momento $oficio);
}