/* 
 * CONTROLA LOS EVENTOS DEL FORMULARIO BUSCAR ROL
 */
$(document).ready(function () {

    $('#tablaRoles').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy',
            'excel',
            {extend: 'pdfHtml5',
                title: 'Roles',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                text: 'PDF'
            }
        ],
        language: {url: "./lib/js/Spanish.json"
        }
    });

    /* MODAL PARA CARGAR ROL */

    $('#tablaPermisosRol').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        language: {url: "/lib/js/Spanish.json"
        }
    });

    /* CARGA EL MODAL PARA NUEVO ROL */

    $('#btnNuevoRol').click(function () {
        $('#mdCargarRol').modal({});
        return false;
    });


    $('#todosPermisos').change(function () {
        if ($(this).is(':checked')) {
            $("input[name='permisos[]']").each(function () {
                $(this).prop('checked', true);
            });
        } else {
            $("input[name='permisos[]']").each(function () {
                $(this).prop('checked', false);
            });
        }
    });

    /* CONFIRMA LA OPERACION DE ALTA. REALIZA LAS VALIDACIONES Y MUESTRA EL RESULTADO */

    $('#btnCargarRol').click(function () {
        var nombre = $("#nombreRol").val();
        if (nombre.length > 0) {
            $("#nombreRol").css("border", "");
            var hay = false;
            $("input[name='permisos[]']").each(function () {
                if ($(this).is(':checked')) {
                    hay = true;
                }
            });
            if (hay === false) {
                $("#tablaPermisosRol").css("border", "1px solid red");
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "procesarCargarRol.php",
                    data: $("#formCargarRol").serialize(),
                    success: function (data) {
                        $("#contenido").empty();
                        $("#contenido2").html(data);
                    },
                    error: function () {
                        $("#contenido").empty();
                        $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
                    }
                });
                $('#mdCargarRol').modal('toggle');
                return false;
            }

        } else {
            $("#nombreRol").css("border", "1px solid red");
        }

    });

    /* CANCELA EL ALTA DE ROL. LIMPIA EL FORMULARIO Y CIERRA EL MODAL */

    $('#btnCancelarCarga').click(function () {
        $("#nombreRol").css("border", "");
        $('#mdCargarRol').modal('toggle');
    });

    /* MODIFICAR ROL */

    $('form.formModificarRol').click(function (e) {
        e.preventDefault();
        var idrol = $(this).attr("name");
        $("#formModificarRol").attr("action", "formModificarRol.php?id_rol=" + idrol);
        $("#formModificarRol").submit();
        return false;
    });

    /* MODAL PARA BORRAR ROLES */

    $('form.borrarRol').submit(function () {
        var idrol = $(this).attr("name");
        $("#seleccionado").val(idrol);
        $('#mdBorrar').modal({});
        return false;
    });

    /* CANCELA LA ELIMINACION DEL ROL. OCULTA EL MODAL */

    $('#btnCancelarEliminacion').click(function () {
        $('#mdBorrar').modal('toggle');
    });
    
    /* CONFIRMA LA ELIMINACION. REALIZA LA PETICION Y MUESTRA EL RESULTADO */

    $('#btnConfirmarEliminacion').click(function () {
        var idrol = $("#seleccionado").val();
        $.ajax({
            type: "POST",
            url: "procesarBorrarRol.php",
            data: "seleccionado=" + idrol,
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

