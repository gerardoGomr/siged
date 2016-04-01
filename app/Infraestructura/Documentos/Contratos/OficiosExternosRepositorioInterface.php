<?php
namespace Siged\Infraestructura\Documentos\Contratos;

use Siged\Dominio\Documentos\OficioExterno;
use Siged\Infraestructura\Contratos\RepositorioInterface;

interface OficiosExternosRepositorioInterface extends RepositorioInterface
{
    public function guardar(OficioExterno $oficio);
}