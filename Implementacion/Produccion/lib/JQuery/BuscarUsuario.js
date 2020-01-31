/* 
 * CONTROLA LOS EVENTOS DEL FORMULARIO MODIFICAR USUARIO.
 */
$(document).ready(function () {

    /* INCIALIZA DATATABLES PARA LA TABLA DE USUARIOS */
    
    $('#tablaUsuarios').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy',
            'csv',
            'excel',
            {   extend: 'pdfHtml5',
                title: 'Usuarios',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                text: 'PDF'
            }
        ],
        language: {url: "/lib/js/Spanish.json"
        }
    });

    /* MODAL PARA CARGAR UN NUEVO USUARIO */

    $('#btnNuevoUsuario').click(function () {
        $('#mdCargarUsuario').modal({});
        return false;
    });
    
    /* CONFIRMA LA OPERACION DE ALTA. REALIZA LAS VALIDACIONES Y MUESTRA EL RESULTADO */
    
    $('#btnCargarUsuario').click(function () {
        var legajo = $("#legajoUsuario").val();
        
        if (legajo.length > 0) {
            var nombre = $("#nombre").val();
            $("#legajoUsuario").css("border", "");
            if (nombre.length > 0) {
                $("#nombre").css("border", "");
                $.ajax({
                    type: "POST",
                    url: "procesarCargarUsuario.php",
                    data: $("#formCargarUsuario").serialize(),
                    success: function (data) {
                        $("#contenido").empty();
                        $("#contenido2").html(data);
                    },
                    error: function () {
                        $("#contenido").empty();
                        $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
                    }
                });
                $('#mdCargarUsuario').modal('toggle');
                return false;
            } else {
                $("#nombre").css("border", "1px solid red");
            }
        } else {
            $("#legajoUsuario").css("border", "1px solid red");
        }
    });
    
    /* CANCELA EL ALTA DE USUARIO. LIMPIA EL FORMULARIO Y CIERRA EL MODAL */
    
    $('#btnCancelarCarga').click(function () {
        $("#legajoUsuario").css("border", "");
        $("#nombre").css("border", "");
        $('#mdCargarUsuario').modal('toggle');
    });

    /* MODIFICAR USUARIO */

    $('form.modificarUsuario').click(function (e) {
        e.preventDefault();
        var legajo = $(this).attr("name");
        $("#formModificarUsuario").attr("action", "formModificarUsuario.php?legajo=" + legajo);
        $("#formModificarUsuario").submit();
        return false;
    });


    /* MODAL PARA BORRAR USUARIOS */

    $('form.borrarUsuario').submit(function () {
        var legajo = $(this).attr("name");
        $("#seleccionado").val(legajo);
        $('#mdBorrar').modal({});
        return false;
    });
    
    /* CANCELA LA ELIMINACION DEL USUARIO. OCULTA EL MODAL */

    $('#btnCancelarEliminacion').click(function () {
        $('#mdBorrar').modal('toggle');
    });
    
    /* CONFIRMA LA ELIMINACION. REALIZA LA PETICION Y MUESTRA EL RESULTADO */

    $('#btnConfirmarEliminacion').click(function () {
        var legajo = $("#seleccionado").val();
        $.ajax({
            type: "POST",
            url: "procesarBorrarUsuario.php",
            data: "seleccionado=" + legajo,
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

