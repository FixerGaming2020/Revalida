<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

if (isset($_POST['seleccionado'])) {

    $query = "SELECT * FROM usuario WHERE id_rol = " . $_POST['seleccionado'];
    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

    if ($result) {
        if (sqlsrv_has_rows($result)) {
            echo '<div class="alert alert-warning text-center" role="alert"> El rol que intenta borrar tiene relación con usuarios </div>';
        } else {
            if (sqlsrv_begin_transaction(BDConexion::getInstancia()->getConexion()) === false) {
                $log = new Log();
                $log->writeLine("[No se inicializo la transaccion con la base de datos]");
                echo '<div class="alert alert-danger text-center" role="alert"> No se inicializó la transacción con la base de datos </div>';
            } else {
                $queryRP = "DELETE FROM rol_permiso WHERE id_rol = " . $_POST['seleccionado'];
                $resultRP = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryRP);

                $queryR = "DELETE FROM rol WHERE id_rol = " . $_POST['seleccionado'];
                $resultR = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryR);

                if ($resultRP && $resultR) {
                    sqlsrv_commit(BDConexion::getInstancia()->getConexion());
                    echo '<div class="alert alert-success text-center" role="alert"> Se realizó la eliminación del rol correctamente </div>';
                } else {
                    $log = new Log();
                    $log->writeLine("[Error al eliminar el rol o la relacion rol_permiso][QUERY: $queryRP][QUERY: $queryR]");
                    sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
                    echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la eliminación del rol </div>';
                }
            }
        }
    } else {
        $log = new Log();
        $log->writeLine("[Error al seleccionar usuarios relacionados al rol][QUERY: $query]");
        echo '<div class="alert alert-danger text-center" role="alert"> No se pudo consultar la relación del rol con usuarios </div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el rol seleccionado por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió la información del rol </div>';
}