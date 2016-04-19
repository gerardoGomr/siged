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
        $this->ruta = 'storage/app/documentos/direccion_general/oficios_recibidos/';
    }

    /**
     * guardar un oficio externo registrado en un directorio del sistema
     * especificado por la ruta
     * @param string $rutaTemporal
     * @param OficioExterno $oficio
     * @throws \FileException
     */
    public function subir($rutaTemporal, OficioExterno $oficio)
    {
        // preparar para guardar en directorio
        // 1er paso poner un nombre válido en base a directorios windows
        $folio = $oficio->formatearFolio('_');

        if (!move_uploaded_file($rutaTemporal, $this->ruta . $folio . '.pdf')) {
            throw new \FileException('No se pudo mover el archivo al directorio especificado');
        }
    }

    public function asignarEscaneado(OficioExterno $oficio)
    {
        if (!file_exists($this->rutaBase)) {
            return null;
        }

        $archivos = scandir($this->rutaBase);

        if($archivos === false) {
            return null;
        }
    }

    /**
     * devolver la ruta
     * @return string
     */
    public function ruta()
    {
        return $this->ruta;
    }
}