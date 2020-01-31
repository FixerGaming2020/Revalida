/*
 * CONTROLA LOS EVENTOS DEL FORMULARIO MODIFICAR USUARIO
 */
$(document).ready(function () {

    /* LEE LOS CAMPOS ORIGINALES PARA VALIDAR */
    
    var legajo = $("#legajo").val();
    var nombre = $("#nombre").val();
    var idrol = $("#rol").val();
    
    /* REALIZA LAS VALIDACIONES, PROCESA LA PETICION Y MUESTRA EL RESULTADO */

    $("#btnModificarUsuario").click(function (e) {
        e.preventDefault();
        var nuevoNombre = $("#nombre").val();
        var nuevoIdrol = $("#rol").val();
        if ((nombre === nuevoNombre) && (idrol === nuevoIdrol)) {
            $('<div class="alert alert-warning text-center" role="alert"> No hubo modificaciones </div>').insertBefore( "#contenido" );
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "procesarModificarUsuario.php",
                data: $("#formModificarUsuario").serialize()+"&legajo="+legajo,
                success: function (data) {
                    $("#contenido").empty();
                    $("#contenido2").html(data);
                },
                error: function () {
                    $("#contenido").empty();
                    $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
                }
            });
        }
    });

});
