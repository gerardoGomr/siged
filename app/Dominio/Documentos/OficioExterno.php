<?php
namespace Siged\Dominio\Documentos;

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
     * @var string
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
     * @var string
     */
    private $rutaEscaneado;

    public function __construct($fecha, $numero, $remitente, $asunto)
    {
        $this->fecha        = $fecha;
        $this->numero       = $numero;
        $this->remitente    = $remitente;
        $this->asunto       = $asunto;
        $this->destinatario = 'Dr. Moisés Grajales';
    }

    public function generarFolio(Folio $folio)
    {
        $numero       = '';
        $longitud     = strlen((string)$folio->numero());
        $longitudBase = 4 - $longitud;

        for ($i = 1; $i <= $longitudBase; $i++) {
            $numero .= '0';
        }

        $numero .= (string)$folio->numero();

        $this->folioEntrada = 'CECCC/DG/PAPELETA/' . $numero . '/' . date('Y');

        $folio->actualizar();
    }

    public function guardarEscaneado($rutaTemporal)
    {

    }

    public function formatearFolio($caracter)
    {
        return str_replace('/', $caracter, $this->folioEntrada);
    }

    public function folioEntrada()
    {
        return $this->folioEntrada;
    }
}