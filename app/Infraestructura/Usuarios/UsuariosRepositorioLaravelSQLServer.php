<?php
namespace Siged\Infraestructura\Usuarios;

use DB;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Siged\Dominio\Usuarios\Usuario;
use Siged\Dominio\Usuarios\Area;
use Siged\Dominio\Usuarios\Puesto;
use Siged\Servicios\PDOLogger;
use Siged\Servicios\Coleccion;

/**
 * Class UsuariosRepositorioInterface
 * @package Sise\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class UsuariosRepositorioLaravelSQLServer implements UsuariosRepositorioInterface
{
    /**
     * obtener usuario
     * @param string $username
     * @return Usuario
     */
    public function obtenerUsuarioPorUsername($username)
    {
        try {
            $usuarios = DB::table('usuario')
                ->join('area_laboral', 'area_laboral.id', '=', 'usuario.area_laboral_id')
                ->join('puesto', 'puesto.id', '=', 'usuario.puesto_id')
                ->where('usuario.username', $username)
                ->select('usuario.*', 'area_laboral.id', DB::raw('area_laboral.nombre AS nombre_area'), 'puesto.*')
                ->first();

            $totalUsuarios = count($usuarios);

            if ($totalUsuarios > 0) {
                $usuario = new Usuario($usuarios->username, $usuarios->passwd, $usuarios->nombre, $usuarios->paterno, $usuarios->materno);
                $usuario->setId($usuarios->id);
                $usuario->setArea(new Area($usuarios->area_laboral_id, $usuarios->nombre_area));
                $usuario->setPuesto(new Puesto($usuarios->puesto_id, $usuarios->puesto));
                $usuario->setActivo($usuarios->activo);

                return $usuario;
            }

            return null;

        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * @return Collection
     */
    public function obtenerTodos()
    {
        // TODO: Implement obtenerTodos() method.
        try {
            $listaUsuarios = new Coleccion();
            $usuarios = DB::table('usuario')
                ->join('area_laboral', 'area_laboral.id', '=', 'usuario.area_laboral_id')
                ->join('puesto', 'puesto.id', '=', 'usuario.puesto_id')
                ->select('usuario.*', 'area_laboral.id', DB::raw('area_laboral.nombre AS nombre_area'), 'puesto.*')
                ->get();

            $totalUsuarios = count($usuarios);

            if ($totalUsuarios > 0) {
                foreach ( $usuarios as $usuarios ) {
                    $usuario = new Usuario($usuarios->username, $usuarios->passwd, $usuarios->nombre, $usuarios->paterno, $usuarios->materno);
                    $usuario->setId($usuarios->id);
                    $usuario->setArea(new Area($usuarios->area_laboral_id, $usuarios->nombre_area));
                    $usuario->setPuesto(new Puesto($usuarios->puesto_id, $usuarios->puesto));
                    $usuario->setActivo($usuarios->activo);

                    $listaUsuarios->attach($usuario);
                }

                return $listaUsuarios;
            }

            return null;

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
        // TODO: Implement obtenerPorId() method.
        try {
            $usuarios = DB::table('usuario')
                ->join('area_laboral', 'area_laboral.id', '=', 'usuario.area_laboral_id')
                ->join('puesto', 'puesto.id', '=', 'usuario.puesto_id')
                ->where('usuario.id', $id)
                ->select('usuario.*', 'area_laboral.id', DB::raw('area_laboral.nombre AS nombre_area'), 'puesto.*')
                ->first();

            $totalUsuarios = count($usuarios);

            if ($totalUsuarios > 0) {
                $usuario = new Usuario($usuarios->username, $usuarios->passwd, $usuarios->nombre, $usuarios->paterno, $usuarios->materno);
                $usuario->setId($usuarios->id);
                $usuario->setArea(new Area($usuarios->area_laboral_id, $usuarios->nombre_area));
                $usuario->setPuesto(new Puesto($usuarios->puesto_id, $usuarios->puesto));
                $usuario->setActivo($usuarios->activo);

                return $usuario;
            }

            return null;

        } catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}