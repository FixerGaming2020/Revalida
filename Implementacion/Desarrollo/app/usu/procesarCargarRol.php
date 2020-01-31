<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

if (isset($_POST['nombreRol']) && $_POST['nombreRol'] != null && isset($_POST['permisos'])) {

    $query = "SELECT * FROM rol WHERE nombre='" . $_POST['nombreRol'] . "'";
    $existe = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);
    if ($existe) {
        if (sqlsrv_has_rows($existe)) {
            echo '<div class="alert alert-warning text-center" role="alert"> El rol ' . $_POST['nombreRol'] . ' ya existe en el sistema </div>';
        } else {
            if (sqlsrv_begin_transaction(BDConexion::getInstancia()->getConexion()) === false) {
                $log = new Log();
                $log->writeLine("[Error al inicializar transacciones en la BD]");
                echo '<div class="alert alert-danger text-center" role="alert"> No se inicializó la transacción con la base de datos </div>';
            } else {

                $query = "INSERT INTO rol VALUES ('{$_POST['nombreRol']}')";
                $resultR = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);
                if ($resultR) {
                    $query = "SELECT id_rol FROM rol WHERE nombre='" . $_POST['nombreRol'] . "'";
                    $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);
                    if ($result && sqlsrv_has_rows($result)) {
                        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                        $idrol = $row['id_rol'];
                        $query = "INSERT INTO rol_permiso VALUES";
                        $values = "";
                        foreach ($_POST['permisos'] as $permiso) {
                            $values = $values . " ($idrol, $permiso),";
                        }
                        $query = $query . substr($values, 0, -1);
                        $resultRP = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);
                        if ($resultRP) {
                            sqlsrv_commit(BDConexion::getInstancia()->getConexion());
                            echo '<div class="alert alert-success text-center" role="alert"> Se realizo la creación del rol correctamente <div>';
                        } else {
                            $log = new Log();
                            $log->writeLine("[Error al crear el rol_permiso en la BD][QUERY: $query]");
                            sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
                            echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la creación del rol (Permisos asociados) <div>';
                        }
                    } else {
                        $log = new Log();
                        $log->writeLine("[Error al crear el rol en la BD][QUERY: $query]");
                        sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
                        echo '<div class="alert alert-danger text-center" role="alert"> No se realizó la creación del rol (No se obtuvo identificador) <div>';
                    }
                } else {
                    sqlsrv_rollback(BDConexion::getInstancia()->getConexion());
                    echo '<div class="alert alert-danger text-center" role="alert"> No se pudo realizar la creación del rol <div>';
                }
            }
        }
    } else {
        $log = new Log();
        $log->writeLine("[Error al consultar rol en la BD][QUERY: $query]");
        echo '<div class="alert alert-warning text-center" role="alert"> No se pudo consultar si existe el rol ingresado </div>';
    }
} else {
    $log = new Log();
    $log->writeLine("[No se recibio el nombre del rol o permisos por POST]");
    echo '<div class="alert alert-danger text-center" role="alert"> No se recibió la información necesaria para la creación </div>';
}


