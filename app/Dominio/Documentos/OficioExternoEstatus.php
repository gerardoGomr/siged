<?php
namespace Siged\Dominio\Documentos;

use Siged\Dominio\Gettable;

/**
 * Class OficioExternoEstatus
 * @package Siged\Dominio\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class OficioExternoEstatus
{
    use Gettable;

    /**
     * @var int
     */
    private $valor;

    /**
     * OficioExternoEstatus constructor.
     * @param int $valor
     */
    private function __construct($valor)
    {
        $this->valor = $valor;
    }

    /**
     * named constructor
     * @return OficioExternoEstatus
     */
    public static function turnado()
    {
        return new self(1);
    }

    /**
     * named constructor
     * @return OficioExternoEstatus
     */
    public static function concluido()
    {
        return new self(2);
    }
}