<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';


if (isset($_POST['legajo']) && isset($_POST['nombre']) && isset($_POST['rol'])) {

    $query = "SELECT * FROM usuario WHERE legajo='" . $_POST['legajo'] . "'";
    $existe = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

    if ($existe) {

        if (sqlsrv_has_rows($existe)) {
            echo '<div class="alert alert-warning text-center" role="alert"> El usuario con legajo ' . $_POST['legajo'] . ' ya existe en el sistema </div>';
        } else {

            $query = "INSERT INTO usuario VALUES ('{$_POST['legajo']}','{$_POST['nombre']}',{$_POST['rol']})";
            $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

            if ($result) {
                echo '<div class="alert alert-success text-center" role="alert"> Se realizo la creación del usuario correctamente <div>';
            } else {
                $log = new Log();
                $log->writeLine("[Error al crear usuario en la BD][QUERY: $query]");
                echo '<div class="alert alert-danger text-center" role="alert"> No se realizo la creación del usuario <div>';
            }
        }
    } else {
        $log = new Log();
        $log->writeLine("[Error al consultar usuario en la BD][QUERY: $query]");
        echo '<div class="alert alert-warning text-center" role="alert"> No se pudo consultar si existe el usuario ingresado </div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el legajo, nombre o rol por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió la información necesaria para la creación </div>';
}