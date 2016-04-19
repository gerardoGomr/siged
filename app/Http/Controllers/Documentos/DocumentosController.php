<?php
namespace Siged\Http\Controllers\Documentos;

use Siged\Dominio\Documentos\Asignacion,
    Siged\Dominio\Documentos\OficioExterno,
    Siged\Dominio\Documentos\Remitente,
    Siged\Http\Requests,
    Siged\Http\Controllers\Controller,
    Siged\Http\Requests\RegistrarOficioRequest,
    Siged\Http\Requests\TurnarOficioRequest,
    Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface,
    Siged\Infraestructura\Documentos\Contratos\OficiosExternosRepositorioInterface,
    Siged\Infraestructura\Usuarios\UsuariosRepositorioInterface,
    Siged\Servicios\Documentos\Factories\PrioridadesAsignacionFactory,
    Siged\Servicios\Documentos\OficiosExtenosUploader,
    Siged\Servicios\Coleccion;

class DocumentosController extends Controller
{
    /**
     * @var FoliosRepositorioInterface
     */
    private $foliosRepositorio;

    /**
     * @var OficiosExternosRepositorioInterface
     */
    private $oficiosExternosRepositorio;

    /**
     * DocumentosController constructor.
     * @param FoliosRepositorioInterface $foliosRepositorio
     * @param OficiosExternosRepositorioInterface $oficiosExternosRepositorio
     */
    public function __construct(FoliosRepositorioInterface $foliosRepositorio, OficiosExternosRepositorioInterface $oficiosExternosRepositorio)
    {
        $this->foliosRepositorio          = $foliosRepositorio;
        $this->oficiosExternosRepositorio = $oficiosExternosRepositorio;
    }

    /**
     * registrar llegada de nuevo oficio externo
     * mostrar vista
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function capturar()
    {
        return view('documentos.oficio_externo_registrar');
    }

    /**
     * registrar un nuevo oficio externo
     * @param RegistrarOficioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registrar(RegistrarOficioRequest $request)
    {
        $oficio = OficioExterno::registrar($request->get('fecha'), $request->get('numero'), new Remitente($request->get('remitente'), $request->get('cargo')), $request->get('asunto'));
        $folio  = $this->foliosRepositorio->obtenerFolioPorNombre('Papeleta');
        $oficio->generar($folio);
        $oficiosUploader = new OficiosExtenosUploader();
        try {
            // guardar los cambios de numero
            $this->foliosRepositorio->actualizar($folio);

            // persistir el oficio
            $this->oficiosExternosRepositorio->guardar($oficio);

            $ruta = $request->file('oficio')->getPathname();
            $oficiosUploader->subir($ruta, $oficio);

            return response()->json([
               'respuesta' => 'success'
            ]);

        } catch (\FileException $e) {
            return response()->json([
                'respuesta' => 'fail'
            ]);
        }
    }

    /**
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $listaOficios    = $this->oficiosExternosRepositorio->obtenerTodos();
        $oficiosUploader = new OficiosExtenosUploader();
        $listaUsuarios   = $usuariosRepositorio->obtenerTodos();
        return view('documentos.oficios_externos', compact('listaOficios', 'oficiosUploader', 'listaUsuarios'));
    }

    /**
     * @param TurnarOficioRequest $request
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function turnar(TurnarOficioRequest $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $oficio = $this->oficiosExternosRepositorio->obtenerPorId((int)base64_decode($request->get('idOficio')));

        // se obtienen los id's
        $usuariosPost = $request->get('usuario');
        $usuarios = new Coleccion();
        foreach ($usuariosPost as $idUsuario) {
            $usuario = $usuariosRepositorio->obtenerPorId($idUsuario);
            $usuarios->attach($usuario);
        }

        $oficio->turnar(new Asignacion($request->get('instruccion'), PrioridadesAsignacionFactory::crear($request->get('prioridad')), $usuarios));

        $respuesta              = [];
        $respuesta['resultado'] = 'ok';
        // persistir cambios
        if (!($this->oficiosExternosRepositorio->guardarAsignacion($oficio))) {
            $respuesta['resultado'] = 'error';
        }

        return response()->json($respuesta);
    }
}
