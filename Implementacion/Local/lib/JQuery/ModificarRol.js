/*
 * CONTROLA LOS EVENTOS DEL FORMULARIO MODIFICAR ROL
 */
$(document).ready(function () {
    
    
    /* VALIDA LOS DATOS, REALIZA LA PETICION Y MUESTRA EL RESULTADO DE LA OPERACION */
    
    $("#btnModificarRol").click(function (e) {
        e.preventDefault();
        var hay = false;
        $("input[name='permisos[]']").each(function () {
            if ($(this).is(':checked')) {
                hay = true;
            }
        });
        if (hay === false) {
            $('<div class="alert alert-warning text-center" id="mensaje" role="alert"> Debe seleccionar permisos </div>').insertBefore("#contenido");
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "procesarModificarRol.php",
                data: $("#formModificarRol").serialize(),
                success: function (data) {
                    $("#mensaje").remove();
                    $("#contenido").empty();
                    $("#contenido2").html(data);
                },
                error: function () {
                    $("#mensaje").remove();
                    $("#contenido").empty();
                    $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
                }
            });
        }
    });

});