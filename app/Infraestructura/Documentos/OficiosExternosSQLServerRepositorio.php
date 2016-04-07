<?php
namespace Siged\Infraestructura\Documentos;

use Siged\Infraestructura\Documentos\Contratos\OficiosExternosRepositorioInterface;
use Siged\Infraestructura\Documentos\DAO\OficiosExternosDAO;
use Siged\Servicios\Contratos\Momento;
use Siged\Servicios\PDOLogger;

class OficiosExternosSQLServerRepositorio implements OficiosExternosRepositorioInterface
{
    /**
     * @var OficiosExternosDAO
     */
    private $oficiosExternosDAO;

    /**
     * OficiosExternosSQLServerRepositorio constructor.
     * @param OficiosExternosDAO $oficiosExternosDAO
     */
    public function __construct(OficiosExternosDAO $oficiosExternosDAO)
    {
        $this->oficiosExternosDAO = $oficiosExternosDAO;
    }

    /**
     * @return Collection
     */
    public function obtenerTodos()
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function obtenerPorId($id)
    {

    }

    /**
     * guardar nuevo oficio en la BD
     * @param Momento $oficio
     * @return bool
     */
    public function guardar(Momento $oficio)
    {
        $this->oficiosExternosDAO->numero           = $oficio->numero;
        $this->oficiosExternosDAO->fecha            = $oficio->fecha;
        $this->oficiosExternosDAO->remitente        = $oficio->remitente->getNombre();
        $this->oficiosExternosDAO->cargo            = $oficio->remitente->getCargo();
        $this->oficiosExternosDAO->asunto           = $oficio->asunto;
        $this->oficiosExternosDAO->destinatario     = $oficio->destinatario;
        $this->oficiosExternosDAO->fecha_creado     = \Carbon\Carbon::createFromDate(date('Y'), date('m'), date('d'));
        $this->oficiosExternosDAO->fecha_modificado = \Carbon\Carbon::createFromDate(date('Y'), date('m'), date('d'));

        try {
            $this->oficiosExternosDAO->save();
            return true;
        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }
}