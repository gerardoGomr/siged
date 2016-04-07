<?php
namespace Siged\Infraestructura\Documentos;

use Siged\Dominio\Documentos\Folio;
use Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface;
use Siged\Infraestructura\Documentos\DAO\FoliosDAO;

/**
 * Class FoliosSQLServerRepositorio
 * @package Siged\Infraestructura\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class FoliosSQLServerRepositorio implements FoliosRepositorioInterface
{
    /**
     * @var FoliosDAO
     */
    private $foliosDAO;

    /**
     * FoliosSQLServerRepositorio constructor.
     * @param FoliosDAO $foliosDAO
     */
    public function __construct(FoliosDAO $foliosDAO)
    {
        $this->foliosDAO = $foliosDAO;
    }

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
     * obtener por nombre de folio
     * @param string $nombre
     * @return Folio
     */
    public function obtenerFolioPorNombre($nombre)
    {
        // query
        $this->foliosDAO = FoliosDAO::where('documento', $nombre)->first();
        // instanciar objeto de dominio
        $folio  = new Folio($this->foliosDAO->numero, $this->foliosDAO->documento);
        // retornar objeto
        return $folio;
    }

    /**
     * actualizar un folio
     * @param Folio $folio
     * @return bool
     */
    public function actualizar(Folio $folio)
    {
        // TODO: Implement actualizar() method.
        $this->foliosDAO->numero           = $folio->numero();
        $this->foliosDAO->documento        = $folio->documento();
        $this->foliosDAO->fecha_modificado = \Carbon\Carbon::createFromDate(date('Y'), date('m'), date('d'));
        $this->foliosDAO->save();

        return true;
    }
}