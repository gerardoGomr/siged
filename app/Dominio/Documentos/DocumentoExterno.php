<?php
namespace Siged\Dominio;
use Siged\Dominio\Usuarios\Usuario;

/**
 * Class DocumentoExterno
 * @package Siged\Dominio
 * @author Gerardo Adrián Gómez Ruiz
 */
class DocumentoExterno extends DocumentoAbstracto implements DocumentoInterface
{
    private $remitente;
    private $destinatario;
    private $oficio;

    /**
     * @param array $datos
     */
    public function registrar(array $datos)
    {
        // TODO: Implement registrar() method.
        $this->destinatario = new Usuario($datos['username']);
        $this->remitente = new Funcionario($datos['funcionario']);
    }
}