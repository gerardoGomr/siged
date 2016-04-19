@extends('app')

@section('contenido')
    <div class="row row-app email">
        <!-- col -->
        <div class="col-md-12">
            <div class="col-separator col-unscrollable box col-separator-first">
                <div class="row row-app">
                    <div class="col-lg-4 col-md-6" id="email_list">
                        <div class="col-separator col-unscrollable box">
                            <div class="col-table">
                                <div class="input-group input-group-lg border-bottom">
                                    <span class="input-group-btn">
                                        <a href="" class="btn"><i class="fa fa-search text-muted"></i></a>
                                    </span>
                                    <input type="text" class="form-control border-none" placeholder="Buscar">
                                </div>

                                <div class="col-table-row">
                                    <div class="col-app col-unscrollable">
                                        <div class="col-app">
                                            <span id="loaderListaOficios" style="display: none;" class="innerAll"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                            <div class="list-group email-item-list" id="listaOficios">
                                                @include('documentos.oficios_externos_lista')
                                            </div>
                                        </div>
                                        <!-- // END col-app -->
                                    </div>
                                    <!-- // END col-app -->
                                </div>
                                <!-- // END col-table-row -->
                            </div>
                            <!-- // END col-table -->
                        </div>
                        <!-- // END col-separator -->
                    </div>
                    <!-- // END col -->

                    <div class="col-lg-8 col-md-6 hidden-sm hidden-xs" id="email_details">
                        <div class="col-separator col-unscrollable col-separator-last">
                            <div class="col-table">
                                <h2 class="innerAll border-bottom bg-gray">Detalles del oficio</h2>

                                <div class="col-table-row">
                                    <div class="col-app col-unscrollable">
                                        <div class="col-app">
                                            <span id="loaderOficioDetalle" style="display: none;" class="innerAll"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                            @include('documentos.oficios_externos_detalle')

                                            <div id="modalformTurnar" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Turnar oficio</h4>
                                                            <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(['url' => url('oficios-recibidos/turnar'), 'id' => 'formTurnar', 'class' => 'form-horizontal'])  !!}
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Prioridad:</label>
                                                                <div class="col-md-9">
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="prioridad" value="normal" class="required"> Normal
                                                                        </label>
                                                                    </div>

                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="prioridad" value="urgente" class="required"> Urgente
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Para:</label>
                                                                <div class="col-md-9">
                                                                    <div class="input-group">
                                                                        <select name="para" id="para" class="form-control">
                                                                            <option>Seleccione</option>
                                                                            @foreach($listaUsuarios as $usuario)
                                                                                <option value="{{ $usuario->getId() }}">{{ $usuario->nombreCompleto() }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <a href="#" id="agregarParticipante" class="btn btn-success btn-sm input-group-btn"><i class="fa fa-plus"></i></a>
                                                                    </div>
                                                                    <div class="separator"></div>
                                                                    <table id="tablaParticipantes" class="table table-striped text-small" style="display:none;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Participante</th>
                                                                            <th>&nbsp;</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="tbody">

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Instrucción:</label>
                                                                <div class="col-md-9">
                                                                    <textarea name="instruccion" id="instruccion" rows="5" class="form-control required"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-9 col-md-offset-3">
                                                                    <input type="button" id="guardarFormTurnar" class="btn btn-primary" value="Turnar >>>">
                                                                    <input type="hidden" id="totalParticipantes" value="0">
                                                                    <input type="hidden" name="idOficio" id="idOficio">
                                                                </div>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col 2 -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('public/js/documentos/oficios_externos.js') }}"></script>
@stop