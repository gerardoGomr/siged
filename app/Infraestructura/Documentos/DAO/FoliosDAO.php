<?php
namespace Siged\Infraestructura\Documentos\DAO;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FoliosDAO
 * @package Siged\Infraestructura\Documentos\DAO
 */
class FoliosDAO extends Model
{
    /**
     * @var string
     */
    protected $table = 'folio';

    /**
     * @var bool
     */
    public $timestamps = false;
}
