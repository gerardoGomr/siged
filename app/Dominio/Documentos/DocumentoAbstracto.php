<?php
/**
 * Created by PhpStorm.
 * User: Rafaelc
 * Date: 18/03/2016
 * Time: 15:21
 */

namespace Siged\Dominio;


abstract class DocumentoAbstracto
{
    protected $id;
    protected $fechaRedaccion;
    protected $fechaRecepcion;
    protected $asunto;
    protected $prioridad;
    protected $estatus;
    protected $anexos;
}