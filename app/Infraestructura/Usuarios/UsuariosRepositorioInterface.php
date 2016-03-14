<?php
namespace Siged\Infraestructura\Usuarios;

/**
 * Interface UsuariosRepositorioInterface
 * @package Siged\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface UsuariosRepositorioInterface
{
    /**
     * obtener usuario
     * @param string $username
     * @return Usuario
     */
    public function obtenerUsuarioPorUsername($username);
}