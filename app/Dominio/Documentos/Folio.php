<?php
namespace Siged\Dominio\Documentos;

/**
 * Class Folio
 * @package Siged\Dominio\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class Folio
{
    /**
     * @var int
     */
    private $numero;

    /**
     * @var string
     */
    private $documento;

    public function __construct($numero)
    {
        $this->numero = $numero;
    }

    public function actualizar()
    {
        $this->numero ++;
    }

    public function numero()
    {
        return $this->numero;
    }

    public function documento()
    {
        return $this->documento;
    }
}