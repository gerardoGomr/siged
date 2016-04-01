<?php
namespace Siged\Servicios\Documentos;

use Siged\Dominio\Documentos\OficioExterno;

/**
 * Class OficiosExtenosUploader
 * @package Siged\Servicios\Documentos
 * @author  Gerardo Adrián Gómez Ruiz
 */
class OficiosExtenosUploader
{
    private $ruta;

    /**
     * OficiosExtenosUploader constructor.
     */
    public function __construct()
    {
        $this->ruta = storage_path('app/documentos/direccion_general/oficios_recibidos/');
    }

    public function subir($rutaTemporal, OficioExterno $oficio)
    {
        // preparar para guardar en directorio
        // 1er paso poner un nombre válido en base a directorios windows
        $folio = $oficio->formatearFolio('_');

        if (!move_uploaded_file($rutaTemporal, $this->ruta . $folio . '.pdf')) {
            throw new \FileException('No se pudo mover el archivo al directorio especificado');
        }
    }
}