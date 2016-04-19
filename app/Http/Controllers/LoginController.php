<?php
namespace Siged\Http\Controllers;

use Illuminate\Http\Request,
    Siged\Http\Requests,
    Siged\Infraestructura\Usuarios\UsuariosRepositorioInterface;

/**
 * Class LoginController
 * @package Siged\Http\Controllers
 * @author Gerardo Adrián Gómez Ruiz
 */
class LoginController extends Controller
{
    /**
     * @var UsuariosRepositorioInterface
     */
    private $usuariosRepositorio;

    /**
     * LoginController constructor.
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     */
    public function __construct(UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $this->usuariosRepositorio = $usuariosRepositorio;
    }

    /**
     * mostrar pantalla de logueo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * login de usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function login(Request $request)
    {
        $username = $request->get('txtUsername');
        $password = $request->get('txtPassword');

        if(!is_null($usuario = $this->usuariosRepositorio->obtenerUsuarioPorUsername($username))) {

            if (!$usuario->login($password)) {
                return $this->loginError();
            }

            $request->session()->put('usuario', $usuario);

            return redirect('/');
        }

        return $this->loginError();
    }

    /**
     * cerrar sesión de usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    /**
     * error al loguear y generar la vista
     * @return View
     */
    public function loginError()
    {
        return view('login')->with('error', 'Usuario y/o contraseña incorrectos');
    }
}