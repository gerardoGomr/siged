<?php
namespace Siged\Dominio\Documentos;

use Siged\Dominio\Gettable;

/**
 * Class OficioExterno
 * @package Siged\Dominio
 * @author Gerardo Adrián Gómez Ruiz
 */
class OficioExterno
{
    use Gettable;

    /**
     * @var int
     */
    private $id;

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
     * @var Asignacion
     */
    private $asignacion;

    /**
     * @var OficioExternoEstatus
     */
    private $estatus;

    /**
     * OficioExterno constructor.
     * @param string $fecha
     * @param string $numero
     * @param Remitente $remitente
     * @param string $asunto
     * @param string $destinatario
     * @param int|null $id
     * @param string|null $folio
     */
    private function __construct($fecha, $numero, Remitente $remitente, $asunto, $destinatario = 'Dr. Moisés Grajales', $id = null, $folio = null)
    {
        $this->fecha        = $fecha;
        $this->numero       = $numero;
        $this->remitente    = $remitente;
        $this->asunto       = $asunto;
        $this->destinatario = $destinatario;
        $this->id           = $id;
        $this->folioEntrada = $folio;
    }

    /**
     * registro de oficio capturado
     * @param string $fecha
     * @param string $numero
     * @param Remitente $remitente
     * @param string $asunto
     * @return OficioExterno
     */
    public static function registrar($fecha, $numero, Remitente $remitente, $asunto)
    {
        return new self($fecha, $numero, $remitente, $asunto);
    }

    /**
     * @param $fecha
     * @param $numero
     * @param Remitente $remitente
     * @param $asunto
     * @param $destinatario
     * @param $id
     * @param $folio
     * @return OficioExterno
     */
    public static function cargar($fecha, $numero, Remitente $remitente, $asunto, $destinatario, $id, $folio)
    {
        return new self($fecha, $numero, $remitente, $asunto, $destinatario, $id, $folio);
    }

    /**
     * registrar un nuevo folio mediante un número de asignación
     * @param Folio $folio
     */
    public function generar(Folio $folio)
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
     * turnar oficio
     * @param Asignacion $asignacion
     */
    public function turnar(Asignacion $asignacion)
    {
        $this->asignacion = $asignacion;
        $this->estatus    = OficioExternoEstatus::turnado();
    }
}