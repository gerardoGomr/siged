<?php
namespace Siged\Infraestructura\Documentos;

use Illuminate\Database\Eloquent\Collection,
    Siged\Dominio\Documentos\OficioExterno,
    Siged\Infraestructura\Documentos\Contratos\OficiosExternosRepositorioInterface,
    Carbon\Carbon,
    DB,
    Monolog\Handler\StreamHandler,
    Monolog\Logger,
    Siged\Servicios\PDOLogger,
    Siged\Dominio\Documentos\Remitente;

/**
 * Class OficiosExternosSQLServerRepositorio
 * @package Siged\Infraestructura\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class OficiosExternosSQLServerRepositorio implements OficiosExternosRepositorioInterface
{
    /**
     * @return Collection|null
     */
    public function obtenerTodos()
    {
        try {
            $listaOficios = new Collection();
            $oficios      = DB::table('oficio_externo')->orderBy('id', 'DESC')->limit(50)->get();
            $total        = count($oficios);

            if ($total === 0) {
                return null;
            }

            foreach ($oficios as $oficios) {
                $listaOficios->push(OficioExterno::cargar($oficios->fecha, $oficios->numero, new Remitente($oficios->remitente, $oficios->cargo), $oficios->asunto, $oficios->destinatario, $oficios->id, $oficios->folio));
            }

            return $listaOficios;

        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function obtenerPorId($id)
    {
        try {

            $oficios = DB::table('oficio_externo')
                ->where('id', $id)
                ->first();

            $total = count($oficios);

            if ($total === 0) {
                return null;
            }

            $oficio = OficioExterno::cargar($oficios->fecha, $oficios->numero, new Remitente($oficios->remitente, $oficios->cargo), $oficios->asunto, $oficios->destinatario, $oficios->id, $oficios->folio);

            return $oficio;

        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * guardar nuevo oficio en la BD
     * @param OficioExterno $oficio
     * @return bool
     */
    public function guardar(OficioExterno $oficio)
    {
        try {
            $numero = DB::table('oficio_externo')
                ->insertGetId([
                    'fecha'        => $oficio->fecha,
                    'numero'       => $oficio->numero,
                    'remitente'    => $oficio->remitente->getNombre(),
                    'cargo'        => $oficio->remitente->getCargo(),
                    'asunto'       => $oficio->asunto,
                    'destinatario' => $oficio->destinatario,
                    'folio'        => $oficio->folioEntrada,
                    'fecha_creado' => Carbon::createFromDate(date('Y'), date('m'), date('d'))
                ]);

            return true;
        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }

    /**
     * guardar asignación
     * @param OficioExterno $oficio
     * @return bool
     */
    public function guardarAsignacion(OficioExterno $oficio)
    {
        // TODO: Implement guardarAsignacion() method.
        try {
            // guardar asignación
            $idAsignacion = DB::table('asignacion')
                ->insertGetId([
                    'oficio_externo_id' => $oficio->id,
                    'prioridad'         => $oficio->asignacion->prioridad->valor,
                    'fecha_asignacion'  => date('d/m/Y H:m:i'),
                    'instruccion'       => $oficio->asignacion->instruccion
                ]);

            // guardar participantes
            foreach ( $oficio->asignacion->participantes as $usuario ) {
                DB::table('usuario_asignacion')
                    ->insert([
                        'usuario_id'       => $usuario->getId(),
                        'asignacion_id'    => $idAsignacion,
                        'fecha_modificado' => date('d/m/Y H:m:i')
                    ]);
            }

            // actualizar estatus de oficio
            DB::table('oficio_externo')
                ->where('id', $oficio->id)
                ->update([
                    'estatus'          => $oficio->estatus->valor,
                    'fecha_modificado' => date('d/m/Y H:m:i')
                ]);

            return true;

        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }
}