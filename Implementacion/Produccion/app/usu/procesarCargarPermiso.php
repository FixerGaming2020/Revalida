<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

if (isset($_POST['nombrePermiso']) && $_POST['nombrePermiso'] != null) {

    $query = "INSERT INTO permiso VALUES('{$_POST['nombrePermiso']}')";
    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

    if ($result) {
        echo '<div class="alert alert-success text-center" role="alert"> Se realizó la carga del permiso correctamente </div>';
    } else {
        $log = new Log();
        $log->writeLine("[No se pudo crear el permiso en la BD][QUERY: $query]");
        echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la carga del permiso </div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el nombre del permiso por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió el nombre del permiso </div>';
}