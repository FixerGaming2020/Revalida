<?php
/* INICIALIZA LA SESION */

	include_once '../conf/Constants.php';
	include_once '../conf/Log.php';
	include_once '../conf/BDConexion.php';

	session_start();
	
	

require_once './header.php';
?>
    <div class="card-header">
        <div id="contenido" style="background: #265d85;">
            <br><div class="row">
                <div class="col">
                    <div class="text-center">
                        <h4 style="color:WHITE"><u>FORMULARIOS</u></h4>
                    </div>
                </div>
            </div>
            <br>
            <div id="centro" class="container">
                <form id="formBuscarEmpleado" name="formBuscarEmpleado" method="POST">
                    <div class="row">
                        <div class="col">
                            <label class="mr-sm-2" style="color:#fcfafa;">LEGAJO:</label> 
                            <input type="number" class="form-control" id="legajo" name="legajo" placeholder="Numero de Legajo">
                        </div>
                        <div class="col">
                            <label class="mr-sm-2" style="color:#fcfafa;">NOMBRE DE USUARIO:</label> 
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de Usuario">
                        </div>
						<div class="col">
                            <label class="mr-sm-2" style="color:#fcfafa;">ESTADO:</label> 
                            <select name="sistema" id="sistema" class="form-control mb-2" title="Estado">
							<option value='!=0'>Todos</option>
							<option value='!=0'>Sin Tratar</option>
							<option value='!=0'>Tratados</option>
							<option value='!=0'>Alta</option>
							<option value='!=0'>Baja</option>
							<option value='!=0'>Solicitud</option>
							</select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <input type="submit" class="btn btn-white" id="btnBuscar" name="btnBuscar" value="Buscar" class="btn btn-bsc mt-4">
								&nbsp;&nbsp;
                                <a href="inicio.php"><input type="button" class="btn btn-white" id="" name="" value="Cancelar"></a>
                            </div>
                        </div>
                    </div><br>
                </form>
            </div>
        </div>
        <div id="contenido2" name="contenido2"></div>

    </div>
	
<div class="modal fade" id="mdProcesando" tabindex="0" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" aria-hidden="false" style="center">
        <div class="modal-dialog modal-lg">
                <div class="text-center">
				<br><br><br><br><br><br><br><br><br><br><br><br>
					<img src="../../lib/img/ajax-loader.gif" class="img-fluid" alt="Responsive image" background="" width="250" height="250">
                </div>
        </div>
</div>

</body>
<script type="text/javascript" charset="utf8">
$(document).ready(function () {
	
    /* CARGA EL RESULTADO DE LA BUSQUEDA EN EL CONTENIDO 2 */
    
    $("#contenido").on("click", "#btnBuscar", function () {
        $.ajax({
            type: "POST",
            url: "procesarBuscarFormularios.php",
            data: $("#formBuscarEmpleado").serialize(),
			beforeSend: function() {
					$('#mdProcesando').modal({show: true, backdrop: 'static'});
			},
            success: function (data) {
                $("#contenido2").html(data);
            },
			complete: function() {
					setTimeout(function(){
						$('#mdProcesando').modal('hide');
					},1000)		
			},
            error: function () {
                $("#contenido2").html('<div class="alert alert-danger text-center" role="alert"> Error al procesar la petición </div>');
            }
        });
        return false;
    });
    
    /* CARGA EL FORMULARIO DE DETALLES EN EL DIV CONTENIDO2 */
    
	
});

</script>
</html>

