<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

if (isset($_POST['seleccionado'])) {

    $query = "DELETE FROM usuario WHERE legajo ='" . $_POST['seleccionado'] . "'";
    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

    if ($result) {
        echo '<div class="alert alert-success text-center" role="alert"> Se realizó la eliminación del usuario correctamente </div>';
    } else {
        $log = new Log();
        $log->writeLine("[Error al borrar el usuario de la BD][QUERY: $query]");
        echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la eliminación del usuario </div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el usuario seleccionado por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió el legajo del usuario </div>';
}
