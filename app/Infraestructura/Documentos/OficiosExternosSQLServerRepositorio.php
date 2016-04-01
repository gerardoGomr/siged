<?php
namespace Siged\Infraestructura\Documentos;

use Siged\Dominio\Documentos\OficioExterno;
use Siged\Infraestructura\Documentos\Contratos\OficiosExternosRepositorioInterface;

class OficiosExternosSQLServerRepositorio implements OficiosExternosRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerTodos()
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function obtenerPorId($id)
    {

    }

    /**
     * guardar nuevo oficio en la BD
     * @param OficioExterno $oficio
     */
    public function guardar(OficioExterno $oficio)
    {
        $oficios               = new OficiosExternos();
        $oficios->numero       = $oficio->getNumero();
        $oficios->fecha        = $oficio->getFecha();
        $oficios->remitente    = $oficio->getRemitente();
        $oficios->asunto       = $oficio->getAsunto();
        $oficios->destinatario = $oficio->getDestinatario();

        $oficios->save();
    }
}