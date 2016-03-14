<?php
namespace Siged\Dominio\Usuarios;
use Siged\Dominio\Personas\Persona;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
abstract class Usuario extends Persona
{
    /**
     * @var int
     */
    protected $id;

    /**
     * nombre de usuario
     * @var string
     */
    protected $username;

    /**
     * contraseña, encriptada
     * @var string
     */
    protected $contrasenia;

    /**
     * estatus activo/inactivo
     * @var int
     */
    protected $activo;

    /**
     * el Area al que pertenece
     * @var Area
     */
    protected $area;

    /**
     * puesto que tiene
     * @var Puesto
     */
    protected $puesto;

    /**
     * fotografia del usuario
     * @var Fotografia
     */
    protected $fotografia;

    /**
     * Usuario constructor.
     * @param string $username
     * @param string $contrasenia
     */
    public function __construct($username = '', $contrasenia = '')
    {
        $this->username    = $username;
        $this->contrasenia = $contrasenia;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the nombre de usuario.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the nombre de usuario.
     *
     * @param string $username the username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Gets the contraseña, encriptada.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Sets the contraseña, encriptada.
     *
     * @param string $contrasenia the passwd
     */
    public function setPasswd($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * obtener el nombre completo del funcionario
     * @return string
     */
    public function getNombreCompleto()
    {
        $nombreCompleto = $this->nombre;

        if(!empty($this->paterno)) {
            $nombreCompleto .= ' '.$this->paterno;
        }

        if(!empty($this->materno)) {
            $nombreCompleto .= ' '.$this->materno;
        }
        return $nombreCompleto;
    }

    /**
     * verifica que la contraseña del usuario coincida con el parametro
     * proporcionado
     * @param  string $contrasenia
     * @return bool
     */
    private function verificarContrasenia($contrasenia)
    {
        if(!password_verify($contrasenia, $this->contrasenia)) {
            return false;
        }

        return true;
    }

    /**
     * verificar si el usuario esta o no activo
     * @return bool
     */
    public function activo()
    {
        if($this->activo === false) {
            return false;
        }

        return true;
    }

    /**
     * setear si es o no activo
     * @param mixed $activo
     */
    public function setActivo($activo)
    {
        if(is_string($activo)) {
            if($activo === '1') {
                $this->activo = true;

            } else {
                $this->activo = false;
            }

        } else {
            $this->activo = $activo;
        }
    }

    /**
     * encriptar la contraseña proporcionada
     * @param  string $passwordSinHash
     * @return string
     */
    public static function encryptaPassword($passwordSinHash)
    {
        return password_hash($passwordSinHash, PASSWORD_DEFAULT);
    }

    /**
     * loguear usuario
     * @param string $password
     * @return bool
     */
    public function login($password)
    {
        if (!$this->verificarContrasenia($password)) {
            return false;
        }

        if (!$this->activo) {
            return false;
        }

        return true;
    }
}