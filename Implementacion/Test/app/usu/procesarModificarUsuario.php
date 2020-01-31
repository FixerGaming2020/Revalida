<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

/* Obtiene los datos del formulario de modificacion */

if (isset($_POST['legajo']) && isset($_POST['nombre']) && isset($_POST['rol'])) {

    $query = "UPDATE usuario SET nombre='" . $_POST['nombre'] . "', id_rol= " . $_POST['rol'] . " WHERE legajo='" . $_POST['legajo'] . "'";
    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

    if ($result) {
        echo '<div class="alert alert-success text-center" role="alert"> Se realizó la modificación del usuario correctamente <div>';
    } else {
        $log = new Log();
        $log->writeLine("[Error al realizar la modificacion de usuario en la BD][QUERY: $query]");
        echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la modificación del usuario </div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibieron los campos de usuario (legajo, nombre o rol) por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió la información necesaria para la modificación </div>';
}