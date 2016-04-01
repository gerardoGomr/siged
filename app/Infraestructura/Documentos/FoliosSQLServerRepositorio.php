<?php
namespace Siged\Infraestructura\Documentos;

use Siged\Dominio\Documentos\Folio;
use Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface;

/**
 * Class FoliosSQLServerRepositorio
 * @package Siged\Infraestructura\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class FoliosSQLServerRepositorio implements FoliosRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerTodos()
    {

    }

    /**
     * @param int $id
     * @return Folio
     */
    public function obtenerPorId($id)
    {

    }

    /**
     * @param string $nombre
     * @return Folio
     */
    public function obtenerFolioPorNombre($nombre)
    {
        // query
        $folios = Folios::where('documento', '=', $nombre)->first();
        // instanciar objeto de dominio
        $folio  = new Folio($folios->numero);
        // retornar objeto
        return $folio;
    }
}