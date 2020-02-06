<?php

require_once 'conf/Constants.php';
require_once 'conf/Log.php';
include_once 'conf/BDConexion.php';

/* inicializa la sesion */
session_start();
$_SESSION['ingresa'] = true;

/* Recibe los datos del formulario */
$user = $_POST['user'];
$pass = $_POST['password'];
$redireccion = "../../../index.php";

try {
    $ldap_connection = ldap_connect(HOST_LDAP, PORT_LDAP);
    if ($ldap_connection) {

        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        $userDomain = DOMINIO_LDAP . $user;



        if (@ldap_bind($ldap_connection, $userDomain, $pass)) {
            /* PORCION DE CODIGO QUE REDIRECCIONA A LA PAGINA DE ACCESO */
            // $_SESSION['usuario'] = $user;
            // $_SESSION['clave'] = $pass;

            $query = "SELECT * FROM usuario WHERE legajo='{$user}'";
            $result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

            if ($result) {
                if (sqlsrv_has_rows($result)) {
                    $usuario = sqlsrv_fetch_array($result);
                    $_SESSION['mensajeLogin'] = "";
                    $_SESSION['usuario'] = $usuario['legajo'];
                    $_SESSION['id']  = $usuario['id'];
                    $_SESSION['user'] = $usuario['nombre'];
                    $_SESSION['idrol'] = $usuario['id_rol'];
                    $_SESSION['apellido'] = $usuario['apellido'];
                    $_SESSION['cargo'] = $usuario['cargo'];
                    $_SESSION['gerencia'] = $usuario['gerencia'];

                    $redireccion = "derivador.php";
                } else {
                    $log = new Log();
                    $log->writeLine("[Usuario no autenticado][{$user}][{$query}]");
                    $_SESSION['mensajeLogin'] = "<div class='alert-danger text-center'>Usuario no autenticado para SBC</div>";
                }
            } else {
                $log = new Log();
                $log->writeLine("[Error durante la consulta a la BD][{$user}][{$query}]");
                $_SESSION['mensajeLogin'] = "<div class='alert-danger text-center'>No se pudo autenticar al usuario</div>";
            }
        } else {
            /* PORCION DE CODIGO QUE REDIRECCIONA AL FORMULARIO LOGIN */
            $log = new Log();
            $log->writeLine("[Usuario no autenticado en LDAP][{$userDomain}]");
            $_SESSION['mensajeLogin'] = "<br><div class='alert-danger text-center'>Usuario no autenticado</div>";
        }
    } else {
        $log = new Log();
        $log->writeLine("[Excepcion durante conexion LDAP][" . HOST_LDAP . "][" . PORT_LDAP . "]");
        $_SESSION['mensajeLogin'] = "<br><div class='alert-danger text-center'>Ocurrió un error durante la autenticación</div>";
    }
} catch (Exception $e) {
    $log = new Log();
    $log->writeLine("[No se establecio la conexion LDAP][{$e->getCode()}][{$e->getMessage()}]");
    $_SESSION['mensajeLogin'] = "<br><div class='alert-danger text-center'>Ocurrió un error durante la autenticación</div>";
}
header("Location: " . $redireccion);
