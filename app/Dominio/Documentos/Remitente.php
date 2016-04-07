<?php
namespace Siged\Dominio\Documentos;

/**
 * Class Remitente
 * @package Siged\Dominio\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class Remitente
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $cargo;

    public function __construct($nombre, $cargo)
    {
        $this->nombre = $nombre;
        $this->cargo  = $cargo;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }
}