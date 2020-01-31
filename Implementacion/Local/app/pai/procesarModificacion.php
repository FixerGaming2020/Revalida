<?php
include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

/* Obtiene los datos del formulario de modificacion */

$id = $_POST['id'];
$cuit = $_POST['cuit'];
$nombre = $_POST['nombre'];
$legajo = $_POST['legajo'];


/* empieza la transaccion*/

sqlsrv_begin_transaction(BDConexion::getInstancia()->getConexion());

/* PREPARA LOS UPDATE PARA EJECUTAR */

if ($id) {
    $sql = "UPDATE [8empleadosBanco] SET [cuit] = '".$cuit."' , [nombre] = '".$nombre."' , [legajo] = '".$legajo."' WHERE id =" . $id;
    $elimina = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $sql); 
        
} else {
    echo $mensaje = "No se obutvieron los datos del usuario";
}

$html = '';
if ($elimina) {
    sqlsrv_commit(BDConexion::getInstancia()->getConexion());
    function mensaje(){
    $html = '
                        <h1><u>Empleado modificado con exito</u></h1>
                    <h3 class="h3 mb-3 font-weight-normal text-blue">Seleccione una opcion:</h3> ';
    return $html;
	}
} else {
    $log = new Log();
    $log->writeLine("[Error al modificar Empleado en la BD][INFO: $elimina]");
    sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
    function mensaje(){
    $html = '
                        <div class=alert-danger><h2 class=text-center>Ocurrio Un Error Al Modificar un Empleado</h2></div>
						<h3 class="h3 mb-3 font-weight-normal text-blue">Seleccione una opcion:</h3>';
    return $html;
	}
}
?>

    <body>
        <div class="container">
		<div id="contenido">
            <div class="card-header">
                <div class="form-row align-items-center mx-auto">
                    <div class="col-lg-12 text-center">
                        <?php echo $output = mensaje(); ?>
                    </div>
                </div>
                <br>
                <div class="form-row align-items-center mx-auto">
                <div class="col-lg-2 text-center">
                </div>
                <div class="col-lg-8 text-center">
                    <a href="alta.php"> <button class="btn btn-lg btn-bsc btn-block" type="submit">Alta de Personal</button></a>
                </div>
            </div>
            <br>
            <div class="form-row align-items-center mx-auto">
                <div class="col-lg-2 text-center">
                </div>
                <div class="col-lg-8 text-center">
                    <a href="baja.php"> <button class="btn btn-lg btn-bsc btn-block" type="submit">Baja/Modificacion de Personal</button></a>
                </div>
            </div>
            <br>
            <div class="form-row align-items-center mx-auto">
                <div class="col-lg-2 text-center">
                </div>
                <div class="col-lg-8 text-center">
                    <a href="inicioReportes.php"> <button class="btn btn-lg btn-bsc btn-block" type="submit">Movimientos de Personal</button></a>
                </div>
            </div>
                <br>
                <div class="form-row align-items-center mx-auto">
                    <div class="col-lg-2 text-center">
                    </div>
                    <div class="col-lg-8 text-center">
                        <a href="../procesarLogout.php">
                            <button class="btn btn-lg btn-bsc btn-block" type="submit">Salir</button>
                        </a>
                    </div>
                    <div class="col-lg-2 text-center">
                    </div>
                </div>
                <br>
        </div>
    </body>
</html>






