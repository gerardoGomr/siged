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

    /**
     * Folio constructor.
     * @param int $numero
     * @param string $documento
     */
    public function __construct($numero, $documento)
    {
        $this->numero    = $numero;
        $this->documento = $documento;
    }

    /**
     * sumar numero mas uno
     * @return void
     */
    public function actualizar()
    {
        $this->numero ++;
    }

    /**
     * @return int
     */
    public function numero()
    {
        return $this->numero;
    }

    /**
     * @return string
     */
    public function documento()
    {
        return $this->documento;
    }
}