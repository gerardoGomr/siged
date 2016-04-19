(function(yourcode) {
    // The global jQuery object is passed as a parameter
    yourcode(window.jQuery, window, document);
} (function($, window, document) {
    // Listen for the jQuery ready event on the document
    $(function () {
        // variables jQuery
        var $listaOficios        = $('#listaOficios'),
            $loaderListaOficios  = $('#loaderListaOficios'),
            $loaderOficioDetalle = $('#loaderOficioDetalle'),
            $numero              = $('#numero'),
            $formTurnar          = $('#formTurnar'),
            $guardarFormTurnar   = $('#guardarFormTurnar'),
            $para                = $('#para'),
            $tablaParticipantes  = $('#tablaParticipantes'),
            urlBase              = $('#numero').attr('href'),
            totalParticipantes   = 0;

        // inicializar validaciones
        init();

        // validate
        $formTurnar.validate();

        // validaciones
        agregaValidacionesElementos($formTurnar);

        // ==================================================================================================================
        // evento click de un oficio de la lista presentada
        $listaOficios.on('click', 'a.oficioSeleccionado', function (event) {
            event.preventDefault();

            // inicializar valor de href de escaneado
            $numero.attr('href', urlBase);

            // mostrar contenido oculto
            $loaderOficioDetalle.show(300);

            // setear datos del elemento
            $('#fecha').text($(this).children('input[name="fecha"]').data('id'));
            $('#destinatario').text($(this).children('input[name="destinatario"]').data('id'));
            $('#remitente').text($(this).children('input[name="remitente"]').data('id'));
            $('#cargo').text($(this).children('input[name="cargo"]').data('id'));
            $('#remitenteCompleto').text($(this).children('input[name="remitente"]').data('id') + "\n\r" + $(this).children('input[name="cargo"]').data('id'));
            $numero.text($(this).children('input[name="numero"]').data('id'));

            // asignar el id oficio al formulario de captura de asignaciones
            $('#idOficio').val(btoa($(this).children('input[name="id"]').data('id')));

            // setear link
            var url           = $numero.attr('href'),
                urlADesplegar = $(this).children('input[name="numeroRuta"]').data('id') + '.pdf';
            $numero.attr('href', url + '/' + urlADesplegar);

            // mostrar vista de detalles
            $loaderOficioDetalle.hide(300);

            $('#detallesOficio').show(300)
            $('#tituloDefault').hide(300)
        });
        // ==================================================================================================================
        // agregar participantes para la atención del oficio
        $('#agregarParticipante').on('click', function(event) {
            event.preventDefault();

            if ($para.val() !== 'Seleccione') {
                var existe = false;
                // verificar que el participante no esté agregado
                $('#tbody').find('tr').each(function(index) {
                    console.log(index + ": " + $( this ).attr('id'));
                    if ($(this).attr('id') === 'participante_' + $para.val()) {
                        existe = true;
                        return false;
                    }
                });

                // si existe, abortar función
                if (existe === true) {
                    bootbox.alert('Este participante ya ha sido agredado.')
                    return false;
                }

                $tablaParticipantes.show(300);

                // construyendo elementos HTML
                var $tr  = $('<tr/>', {
                        id: 'participante_' + $para.val()
                    }),
                    $td1 = $('<td/>', {
                        text: $para.find('option:selected').text(),
                    }),
                    $td2 = $('<td/>'),
                    $a   = $('<a/>', {
                        class: 'eliminarParticipante',
                        href:  '#'
                    }),
                    $i   = $('<i/>', {
                        class: 'fa fa-times'
                    }),
                    $input = $('<input/>', {
                        name: 'usuario[]',
                        type: 'hidden',
                        value: $para.val()
                    });

                // asignando elementos HTML construídos
                $a.append($i);
                $td2.append($a);
                $td1.append($input);
                $tr.append($td1);
                $tr.append($td2);
                $('#tbody').append($tr);

                totalParticipantes++;
            }
        });

        // eliminar un participante
        $tablaParticipantes.on('click', 'a.eliminarParticipante', function(event) {
            var $tr = $(this).parents('tr');

            $tr.remove();

            totalParticipantes--;

            if (totalParticipantes === 0) {
                $tablaParticipantes.hide(300);
            }
        });
        // ==================================================================================================================

        // guardar form turnar
        $guardarFormTurnar.on('click', function(event) {
            event.preventDefault();

            if ($formTurnar.valid() === true) {
                // guardar
                if (totalParticipantes === 0) {
                    bootbox.alert('Por favor, seleccione al menos un participante.');
                    return false;
                }

                bootbox.confirm('Se procederá a turnar este oficio a los participantes seleccionados, ¿desea continuar?', function(respuesta) {
                    if (respuesta === true) {
                        var respuestaAjax = $.ajax({
                            url :     $formTurnar.attr('action'),
                            type:     'post',
                            data:     $formTurnar.serialize(),
                            dataType: 'json'
                        });

                        respuestaAjax.done(function(respuesta) {
                            if (respuesta.resultado === 'error') {
                                bootbox.alert('Ocurrió un error al turnar a este oficio. Intente nuevamente.');
                                return false;
                            }

                            bootbox.alert('Oficio turnado con éxito.', function(){
                                // recargar página
                                window.location.reload(true);
                            });
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus + ': ' + errorThrown);
                            bootbox.alert('Imposible realizar la operación solicitada.');
                        });
                    }
                });
            }
        });
    });
    }
));