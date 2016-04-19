<?php
namespace Siged\Dominio\Documentos;

use Siged\Dominio\Gettable,
    Siged\Servicios\Coleccion;

/**
 * Class Asignacion
 * @package Siged\Dominio\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class Asignacion
{
    use Gettable;

    /**
     * @var string
     */
    private $instruccion;

    /**
     * @var PrioridadAsignacion
     */
    private $prioridad;

    /**
     * @var Coleccion
     */
    private $participantes;

    /**
     * Asignacion constructor.
     * @param string $instruccion
     * @param PrioridadAsignacion $prioridad
     * @param Coleccion $participantes
     */
    public function __construct($instruccion, PrioridadAsignacion $prioridad, Coleccion $participantes)
    {
        $this->instruccion   = $instruccion;
        $this->prioridad     = $prioridad;
        $this->participantes = $participantes;
    }
}