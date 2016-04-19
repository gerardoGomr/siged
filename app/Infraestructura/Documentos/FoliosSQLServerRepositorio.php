<?php
namespace Siged\Infraestructura\Documentos;

use Carbon\Carbon,
    DB,
    Siged\Dominio\Documentos\Folio,
    Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface,
    Monolog\Handler\StreamHandler,
    Monolog\Logger,
    Siged\Servicios\PDOLogger;

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
     * obtener por nombre de folio
     * @param string $nombre
     * @return Folio
     */
    public function obtenerFolioPorNombre($nombre)
    {
        // query
        try {
            $folios = DB::table('folio')->where('documento', $nombre)->first();
            // instanciar objeto de dominio
            $folio  = new Folio($folios->numero, $folios->documento);
            // retornar objeto
            return $folio;
        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * actualizar un folio
     * @param Folio $folio
     * @return bool
     */
    public function actualizar(Folio $folio)
    {
        // TODO: Implement actualizar() method.
        try {
            DB::table('folio')
                ->where('documento', $folio->documento())
                ->update([
                    'numero'           => $folio->numero(),
                    'fecha_modificado' => Carbon::createFromDate(date('Y'), date('m'), date('d'))
                ]);

            return true;
        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }
}