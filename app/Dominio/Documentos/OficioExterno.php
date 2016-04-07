<?php
namespace Siged\Dominio\Documentos;
use Siged\Servicios\Contratos\Momento;
use Siged\Servicios\Documentos\OficiosExternosMomento;

/**
 * Class OficioExterno
 * @package Siged\Dominio
 * @author Gerardo Adrián Gómez Ruiz
 */
class OficioExterno
{
    /**
     * @var string
     */
    private $fecha;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var string
     */
    private $folioEntrada;

    /**
     * @var Remitente
     */
    private $remitente;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $destinatario;

    /**
     * OficioExterno constructor.
     * @param string $fecha
     * @param string $numero
     * @param Remitente $remitente
     * @param string $asunto
     */
    public function __construct($fecha, $numero, Remitente $remitente, $asunto)
    {
        $this->fecha        = $fecha;
        $this->numero       = $numero;
        $this->remitente    = $remitente;
        $this->asunto       = $asunto;
        $this->destinatario = 'Dr. Moisés Grajales';
    }

    /**
     * registrar un nuevo folio mediante un número de asignación
     * @param Folio $folio
     */
    public function registrar(Folio $folio)
    {
        $numero       = '';
        $longitud     = strlen((string)$folio->numero());
        $longitudBase = 4 - $longitud;

        for ($i = 1; $i <= $longitudBase; $i++) {
            $numero .= '0';
        }

        $numero .= (string)$folio->numero();

        $this->folioEntrada = 'CECCC/DG/PAPELETA/' . $numero . '/' . date('Y');

        // actualizar en 1 el folio que se ocupó
        $folio->actualizar();
    }

    /**
     * formatear el folio de entrada por el caracter que se especifica
     * @param string $caracter
     * @return string
     */
    public function formatearFolio($caracter)
    {
        return str_replace('/', $caracter, $this->folioEntrada);
    }

    /**
     * capturar un memento del oficio
     * @return OficiosExternosMomento
     */
    public function capturarMomento()
    {
        return new OficiosExternosMomento($this->fecha, $this->numero, $this->remitente, $this->asunto, $this->destinatario);
    }

    /**
     * regenerar un oficio a partir de un memento determinado
     * @param Momento $momento
     */
    public function regenerarDeMomento(Momento $momento)
    {
        $this->fecha        = $momento->fecha;
        $this->numero       = $momento->numero;
        $this->remitente    = $momento->remitente;
        $this->asunto       = $momento->asunto;
        $this->destinatario = $momento->destinatario;
    }
}