<?php
namespace Siged\Infraestructura\Documentos\DAO;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OficiosExternos
 * @package Siged\Infraestructura\Documentos\DAO
 * @author Gerardo Adrián Gómez Ruiz
 */
class OficiosExternosDAO extends Model
{
    /**
     * @var string
     */
    protected $table = 'oficio_externo';

    /**
     * @var bool
     */
    public $timestamps = false;
}
