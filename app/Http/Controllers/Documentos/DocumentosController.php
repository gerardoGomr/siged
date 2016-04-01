<?php
namespace Siged\Http\Controllers\Documentos;

use Siged\Dominio\Documentos\OficioExterno;
use Siged\Http\Requests;
use Siged\Http\Controllers\Controller;
use Siged\Http\Requests\RegistrarOficioRequest;
use Siged\Infraestructura\Documentos\Contratos\FoliosRepositorioInterface;
use Siged\Servicios\Documentos\OficiosExtenosUploader;

class DocumentosController extends Controller
{
    /**
     * @var FoliosRepositorioInterface
     */
    private $foliosRepositorio;

    /**
     * DocumentosController constructor.
     * @param FoliosRepositorioInterface $foliosRepositorio
     */
    public function __construct(FoliosRepositorioInterface $foliosRepositorio)
    {
        $this->foliosRepositorio = $foliosRepositorio;
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


    public function registrar(RegistrarOficioRequest $request)
    {
        $oficio = new OficioExterno($request->get('fecha'), $request->get('numero'), $request->get('remitente'), $request->get('asunto'));
        $folio  = $this->foliosRepositorio->obtenerFolioPorNombre('Papeleta');
        $oficio->generarFolio($folio);
        $oficiosUploader = new OficiosExtenosUploader();
        try {
            $ruta = $request->file('oficio')->getPathname();
            $oficiosUploader->subir($ruta, $oficio);
        } catch (\FileException $e) {

        }
    }
}
