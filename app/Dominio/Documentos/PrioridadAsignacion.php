<?php
namespace Siged\Dominio\Documentos;

use Siged\Dominio\Gettable;

/**
 * Class PrioridadAsignacion
 * @package Siged\Dominio\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class PrioridadAsignacion
{
    use Gettable;

    /**
     * @var int
     */
    private $valor;

    /**
     * PrioridadAsignacion constructor.
     * @param int $valor
     */
    private function __construct($valor)
    {
        $this->valor = $valor;
    }

    /**
     * named constructor
     * @return PrioridadAsignacion
     */
    public static function normal()
    {
        return new self(1);
    }

    /**
     * named constructor
     * @return PrioridadAsignacion
     */
    public static function urgente()
    {
        return new self(2);
    }
}