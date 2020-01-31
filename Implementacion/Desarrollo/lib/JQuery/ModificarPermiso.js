/* 
 * CONTROLA LOS EVENTOS DEL FORMULARIO MODIFICAR PERMISO
 */
$(document).ready(function () {

    /* ENVIA LA SOLICITUD Y MUESTRA EL RESULTADO DE LA OPERACION */

    $("#btnModificarPermiso").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "procesarModificarPermiso.php",
            data: $("#formModificarPermiso").serialize(),
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
    });

});
