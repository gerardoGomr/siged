<?php
namespace Siged\Servicios\Documentos;

use Siged\Dominio\Documentos\Remitente;
use Siged\Servicios\Contratos\Momento;

/**
 * Class OficiosExternosMomento
 * @package Siged\Servicios\Documentos
 * @author Gerardo Adrián Gómez Ruiz
 */
class OficiosExternosMomento implements Momento
{
    /**
     * @var string
     */
    public $fecha;

    /**
     * @var string
     */
    public $numero;

    /**
     * @var Remitente
     */
    public $remitente;

    /**
     * @var string
     */
    public $asunto;

    /**
     * @var string
     */
    public $destinatario;

    /**
     * OficiosExternosMomento constructor.
     * @param string $fecha
     * @param string $numero
     * @param Remitente $remitente
     * @param string $asunto
     * @param string $destinatario
     */
    public function __construct($fecha, $numero, Remitente $remitente, $asunto, $destinatario)
    {
        $this->fecha        = $fecha;
        $this->numero       = $numero;
        $this->remitente    = $remitente;
        $this->asunto       = $asunto;
        $this->destinatario = $destinatario;
    }
}