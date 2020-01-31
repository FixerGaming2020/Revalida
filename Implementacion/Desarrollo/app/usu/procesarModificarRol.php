<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';


if (isset($_POST['id_rol']) && isset($_POST['nombreRol']) && isset($_POST['permisos'])) {

    if (sqlsrv_begin_transaction(BDConexion::getInstancia()->getConexion()) === false) {
        $log = new Log();
        $log->writeLine("[Error al inicializar transacciones en la BD]");
        echo '<div class="alert alert-danger text-center" role="alert"> No se inicializó la transacción con la base de datos </div>';
    } else {

        $queryMR = "UPDATE rol SET nombre = '{$_POST['nombreRol']}' WHERE id_rol=" . $_POST['id_rol'];
        $resultMR = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryMR);

        $queryDR = "DELETE FROM rol_permiso WHERE id_rol=" . $_POST['id_rol'];
        $resultDR = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryDR);

        $idrol = $_POST['id_rol'];

        $queryIR = "INSERT INTO rol_permiso VALUES";
        $values = "";
        foreach ($_POST['permisos'] as $permiso) {
            $values = $values . " ($idrol, $permiso),";
        }
        $queryIR = $queryIR . substr($values, 0, -1);
        $resultIR = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryIR);

        if ($resultMR && $resultDR && $resultIR) {
            sqlsrv_commit(BDConexion::getInstancia()->getConexion());
            echo '<div class="alert alert-success text-center" role="alert"> Se realizo la modificación del rol correctamente <div>';
        } else {
            $log = new Log();
            $log->writeLine("[Error al confirmar transacciones en la BD][QUERY: $queryMR][QUERY: $queryDR][QUERY: $queryIR]");
            sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
            echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la modificación del rol <div>';
        }
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el idrol, nombreRol o permisos por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió la información necesaria para la modificación </div>';
}
