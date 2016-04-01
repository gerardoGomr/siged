<?php
namespace Siged\Infraestructura\Documentos\Contratos;

use Siged\Infraestructura\Contratos\RepositorioInterface;

/**
 * Interface FoliosRepositorioInterface
 * @package Siged\Infraestructura\Documentos\Contratos
 * @author Gerardo Adrián Gómez Ruiz
 */
interface FoliosRepositorioInterface extends RepositorioInterface
{
    /**
     * @param string $nombre
     * @return Folio
     */
    public function obtenerFolioPorNombre($nombre);
}