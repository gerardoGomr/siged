<?php
namespace Siged\Infraestructura\Usuarios;

use DB;
use Illuminate\Support\Collection;
use Siged\Dominio\Usuarios\Usuario;

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
            $usuario = DB::connection('Integral')
                ->table('tUsuarios')
                ->join('c_Areas', 'c_Areas.idDireccion', '=', 'tUsuarios.departamento')
                ->where('tUsuarios.usuario', $username)
                ->first();

            $totalUsuarios = count($usuario);

            if ($totalUsuarios > 0) {
                $trabajador = new Trabajador($usuario->nombre);
                $trabajador->setUsuario(new UsuarioSise());
                $trabajador->getUsuario()->setUsername($usuario->usuario);
                $trabajador->getUsuario()->setId((int)$usuario->id);
                $trabajador->setArea(new Area((int)$usuario->idDireccion, $usuario->Direccion));

                return $trabajador;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}