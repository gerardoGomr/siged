jQuery(document).ready(function($) {
    var $formRegistro = $('#formRegistro');

    // inicializar validaciones
    init();

    // validate
    $formRegistro.validate();

    // validaciones
    agregaValidacionesElementos($formRegistro);

    // datepicker
    $('#fecha').datepicker({
        format:    'dd/mm/yyyy',
        autoclose: true,
        language:  'es'
    });

    // objeto para subir el form $formRegistro via ajax
    var opciones = {
        url:        $formRegistro.attr('action'),
        type:       'post',
        dataType:   'json',
        beforeSend: function() {
            if($formRegistro.valid() === false) {
                return false;
            }
        },
        success: function(respuesta, statusText, xhr, $form){
            if (respuesta.respuesta === 'fail') {
                bootbox.alert('No se pudo registrar este oficio. Intente de nuevo');
            }

            bootbox.alert('Oficio registrado con éxito', function() {

            });
        },
        error:   function(XMLHttpRequest, textStatus, errorThrown){
            console.log(errorThrown);
            bootbox.alert("Imposible realizar la operación solicitada.");
        }
    };

    // subir la información mediante ajax
    $formRegistro.ajaxForm(opciones);
});