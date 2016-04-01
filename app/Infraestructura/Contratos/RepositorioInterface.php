<?php
namespace Siged\Infraestructura\Contratos;

/**
 * Interface RepositorioInterface
 * @package Siged\Infraestructura\Documentos\Contratos
 * @author Gerardo Adrián Gómez Ruiz
 */
interface RepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerTodos();

    /**
     * @param int $id
     * @return mixed
     */
    public function obtenerPorId($id);
}