<?php
namespace Siged\Dominio;

/**
 * Class Documento
 * @package Siged\Dominio
 * @author Gerardo Adrián Gómez Ruiz
 */
class Documento
{
    /**
     * @var DocumentoInterface
     */
    private $documento;

    private $tipoDocumento;

    const OFICIO              = 1;
    const MEMORANDUM          = 2;
    const TARJETA_INFORMATIVA = 3;
    const CIRCULAR            = 4;

    public function __construct($tipo, DocumentoInterface $documento)
    {
        $this->tipoDocumento = $tipo;
        $this->documento     = $documento;
    }

    public function registrar(array $datos)
    {
        $this->documento->registrar($datos);
    }
}