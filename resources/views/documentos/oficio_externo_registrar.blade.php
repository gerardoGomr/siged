@extends('app')

@section('contenido')
    <div class="row row-app">
        <div class="col-sm-12">
            <div class="col-separator col-unscrollable box col-separator-first">
                <div class="col-table">
                    <h4 class="innerAll border-bottom margin-none">Registro de oficio externo</h4>
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div class="innerAll">
                                    <div class="box-generic">
                                        <div class="innerAll">
                                            {!! Form::open(['url' => 'registrar', 'id' => 'formRegistro', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Fecha:</label>
                                                    <div class="col-md-3">
                                                        <input name="fecha" id="fecha" type="text" class="form-control required" value="{{ date('d/m/Y') }}" readonly="readonly">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Número de oficio:</label>
                                                    <div class="col-md-9">
                                                        <input name="numero" id="numero" type="text" class="form-control required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Remitente:</label>
                                                    <div class="col-md-5">
                                                        <input name="remitente" id="remitente" type="text" class="form-control required" placeholder="Nombre">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <input name="cargo" id="cargo" type="text" class="form-control required" placeholder="Cargo">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Asunto:</label>
                                                    <div class="col-md-9">
                                                        <textarea name="asunto" id="asunto" class="form-control required" rows="5"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Oficio escaneado:</label>
                                                    <div class="col-md-9">
                                                        <input name="oficio" id="oficio" type="file" class="form-control margin-none required pdf">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" class="btn btn-primary" value="Registrar oficio">
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
    </div>
@stop

@section('js')
    <script src="{{ asset('public/js/documentos/oficio_externo_registrar.js') }}"></script>
@stop