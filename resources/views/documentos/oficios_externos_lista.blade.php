@if(count($listaOficios) > 0)
    @foreach($listaOficios as $oficio)
        <a href="#" class="list-group-item oficioSeleccionado">
            <span class="innerTB display-block">
                <span class="media">
                    <span class="pull-left text-center innerLR innerT display-block half"><i class="fa fa-fw fa-envelope text-muted"></i></span>
                    <span class="media-body display-block innerR">
                        <span class="media display-block innerB">

                            <span class="media-body display-block">
                                <small class="text-muted pull-right">{{ $oficio->fecha }}</small>
                                <h4>Secretaría de la Función Pública</h4>
                                <h5 class="text-muted-dark text-weight-normal">{{ $oficio->remitente->getNombre() }}</h5>
                            </span>
                            <span class="clearfix"></span>
                        </span>

                        <p class="margin-none text-larger text-muted-darker">{{ $oficio->asunto }}</p>
                    </span>
                </span>
            </span>
            <input type="hidden" name="fecha" data-id="{{ $oficio->fecha }}">
            <input type="hidden" name="numero" data-id="{{ $oficio->numero }}">
            <input type="hidden" name="remitente" data-id="{{ $oficio->remitente->getNombre() }}">
            <input type="hidden" name="cargo" data-id="{{ $oficio->remitente->getCargo() }}">
            <input type="hidden" name="asunto" data-id="{{ $oficio->asunto }}">
            <input type="hidden" name="destinatario" data-id="{{ $oficio->destinatario }}">
            <input type="hidden" name="numeroRuta" data-id="{{ $oficio->formatearFolio('_') }}">
            <input type="hidden" name="folio" data-id="{{ $oficio->folioEntrada }}">
            <input type="hidden" name="id" data-id="{{ $oficio->id }}">
        </a>
    @endforeach
@else
    <h4>Sin oficios registrados</h4>
@endif