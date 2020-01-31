<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';


if (isset($_POST['id_permiso']) && isset($_POST['nombrePermiso'])) {
    $query = "UPDATE permiso SET nombre='{$_POST['nombrePermiso']}' WHERE id_permiso=" . $_POST['id_permiso'];
    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

    if ($result) {
        echo '<div class="alert alert-success text-center" role="alert"> Se realizó la modificación del permiso correctamente <div>';
    } else {
        $log = new Log();
        $log->writeLine("[Error al modificar permiso en la BD][QUERY: $query]");
        echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la modificación del permiso <div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el idPermiso o nombrePermiso por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió la información necesaria para la modificación </div>';
}
