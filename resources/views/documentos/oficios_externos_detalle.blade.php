<h1 class="text-large innerAll text-muted" id="tituloDefault">Seleccione un oficio</h1>
<div style="display: none;" id="detallesOficio">
    <div class="innerAll">
        <div class="box-generic padding-none animated fadeInUp">
            <div class="innerAll border-bottom bg-gray">
                <a href="#modalformTurnar" class="btn btn-primary pull-right" data-toggle="modal"><i class="fa fa-arrow-left"></i> Turnar a seguimiento</a>
                <div class="clearfix"></div>
            </div>

            <div class="innerAll border-bottom">
                <div class="media-body innerT half">
                    <h5 class="text-muted-darker pull-right strong" id="fecha"> - </h5>
                    <h5 class="text-muted-dark">De: <span id="remitente" class="strong"></span></h5>
                    <h5 class="text-muted"><span id="cargo">(-)</span></h5>
                    <div class="separator"></div>
                    <h5 class="text-muted-dark">Para: <span id="destinatario" class="strong">(-)</span></h5>
                </div>
            </div>

            <div class="innerAll border-bottom">
                <h4 class="innerT margin-none"><i class="fa fa-fw fa-circle-o text-success"></i>Asunto:</h4>
                <div class="separator"></div>
                <p id="asunto"> - </p>
            </div>

            <div class="innerAll bg-gray">
                <div class="media margin-none">
                    <div class="innerLR border-left">
                        <i class="fa fa-file pull-left fa-2x"></i>
                        <div class="media-body">
                            <div><a href="{{ url($oficiosUploader->ruta()) }}" class="strong text-regular" id="numero" target="_blank"></a></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>