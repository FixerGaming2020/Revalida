/*
 * CONTROLA LOS EVENTOS DEL FORMULARIO BUSCAR PERMISOS
 */
$(document).ready(function () {

    /* INICIALIZA DATATABLES PARA LA TABLA DE PERMISOS */

    $('#tablaPermisos').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy',
            'csv',
            'excel',
            {extend: 'pdfHtml5',
                title: 'Permisos',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                text: 'PDF'
            }
        ],
        language: {url: "./lib/js/Spanish.json"
        }
    });

    /* MODAL PARA CARGAR NUEVO PERMISO */

    $('#btnNuevoPermiso').click(function () {
        $('#mdCargarPermiso').modal({});
        return false;
    });

    /* CONFIRMA LA OPERACION DE ALTA. REALIZA LAS VALIDACIONES Y MUESTRA EL RESULTADO */

    $('#btnCargarPermiso').click(function () {
        var nombre = $("#nombrePermiso").val();
        if (nombre.length > 0) {
            $("#nombrePermiso").css("border", "");
            $.ajax({
                type: "POST",
                url: "procesarCargarPermiso.php",
                data: $("#formCargarPermiso").serialize(),
                success: function (data) {
                    $("#contenido").empty();
                    $("#contenido2").html(data);
                },
                error: function () {
                    $("#contenido").empty();
                    $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
                }
            });
            $('#mdCargarPermiso').modal('toggle');
            return false;
        } else {
            $("#nombrePermiso").css("border", "1px solid red");
        }

    });

    /* CANCELA EL ALTA DE PERMISO. CIERRA EL MODAL */

    $('#btnCancelarCarga').click(function () {
        $("#nombrePermiso").css("border", "");
        $('#mdCargarPermiso').modal('toggle');
    });
    
    /* CARGA EL FORMULARIO PARA MODIFICAR EL PERMISO */
    
    $('form.formModificarPermiso').click(function (e) {
        e.preventDefault();
        var idpermiso = $(this).attr("name");
        $("#formModificarPermiso").attr("action", "formModificarPermiso.php?id_permiso=" + idpermiso);
        $("#formModificarPermiso").submit();
        return false;
    });

    /* MODAL PARA BORRAR PERMISOS */

    $('form.borrarPermiso').submit(function () {
        var idpermiso = $(this).attr("name");
        $("#seleccionado").val(idpermiso);
        $('#mdBorrar').modal({});
        return false;
    });

    /* CANCELA LA ELIMINACION DEL PERMISO. OCULTA EL MODAL */
    
    $('#btnCancelarEliminacion').click(function () {
        $('#mdBorrar').modal('toggle');
    });
    
    /* CONFIRMA LA ELIMINACION. REALIZA LA PETICION Y MUESTRA EL RESULTADO */

    $('#btnConfirmarEliminacion').click(function () {
        var idpermiso = $("#seleccionado").val();
        $.ajax({
            type: "POST",
            url: "procesarBorrarPermiso.php",
            data: "seleccionado=" + idpermiso,
            success: function (data) {
                $("#contenido").empty();
                $("#contenido2").html(data);
            },
            error: function () {
                $("#contenido").empty();
                $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
            }
        });
        $('#mdBorrar').modal('toggle');
        return false;
    });


});

