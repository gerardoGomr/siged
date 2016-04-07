<?php
namespace Siged\Http\Controllers\Documentos;

use Siged\Dominio\Documentos\OficioExterno;
use Siged\Dominio\Documentos\Remitente;
use Siged\Http\Requests;
use Siged\Http\Controllers\Controller;
use Siged\Http\Requests\RegistrarOficioRequest;
use Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface;
use Siged\Infraestructura\Documentos\Contratos\OficiosExternosRepositorioInterface;
use Siged\Servicios\Documentos\OficiosExtenosUploader;

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
    public function index()
    {
        return view('documentos.documentos_registrar');
    }

    /**
     * registrar un nuevo oficio externo
     * @param RegistrarOficioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registrar(RegistrarOficioRequest $request)
    {
        $oficio = new OficioExterno($request->get('fecha'), $request->get('numero'), new Remitente($request->get('remitente'), $request->get('cargo')), $request->get('asunto'));
        $folio  = $this->foliosRepositorio->obtenerFolioPorNombre('Papeleta');
        $oficio->registrar($folio);
        $oficiosUploader = new OficiosExtenosUploader();
        try {
            $ruta = $request->file('oficio')->getPathname();
            $oficiosUploader->subir($ruta, $oficio);

            // guardar los cambios de numero
            $this->foliosRepositorio->actualizar($folio);

            // persistir el oficio
            // obtener momento
            $momento = $oficio->capturarMomento();
            $this->oficiosExternosRepositorio->guardar($momento);

            return response()->json([
               'respuesta' => 'success'
            ]);

        } catch (\FileException $e) {
            return response()->json([
                'respuesta' => 'fail'
            ]);
        }
    }
}
