<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

if (isset($_POST['seleccionado'])) {
    if (sqlsrv_begin_transaction(BDConexion::getInstancia()->getConexion()) === false) {
        echo '<div class="alert alert-danger text-center" role="alert"> No se inicializó la transacción con la base de datos </div>';
    } else {

        $queryRP = "DELETE FROM rol_permiso WHERE id_permiso =" . $_POST['seleccionado'];
        $resultRP = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryRP);

        $queryP = "DELETE FROM permiso WHERE id_permiso =" . $_POST['seleccionado'];
        $resultP = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryP);

        if ($resultRP && $resultP) {
            sqlsrv_commit(BDConexion::getInstancia()->getConexion());
            echo '<div class="alert alert-success text-center" role="alert"> Se realizó la eliminación del permiso y sus asociaciones correctamente </div>';
        } else {
            $log = new Log();
            $log->writeLine("[Error al borrar el permiso o la relacion con rol][QUERY: $queryRP][QUERY: $queryP]");
            sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
            echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la eliminación del permiso </div>';
        }
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el permiso seleccionado por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió el nombre del permiso </div>';
}




