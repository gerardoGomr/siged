<?php
namespace Siged\Infraestructura\Usuarios;
use Siged\Infraestructura\Contratos\RepositorioInterface;

/**
 * Interface UsuariosRepositorioInterface
 * @package Siged\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface UsuariosRepositorioInterface extends RepositorioInterface
{
    /**
     * obtener usuario
     * @param string $username
     * @return Usuario
     */
    public function obtenerUsuarioPorUsername($username);
}