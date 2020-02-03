<?php

session_start();

require_once 'conf/Constants.php';
require_once 'conf/Log.php';

if (!isset($_SESSION['ingresa']) || !$_SESSION['ingresa'] || !isset($_SESSION['user'])) {
    $log = new Log();
    $log->writeLine("[No se ha definido que ingresa o no hay usuario en sesion][Redirecciona: index]");
    header("Location: ../index.php");
}

include_once 'conf/BDConexion.php';

$query = "SELECT p.nombre AS nombre
FROM usuario u 
INNER JOIN rol r ON (r.id = u.id_rol)
INNER JOIN rol_permiso rp ON (r.id = rp.id_rol)
INNER JOIN permiso p ON (p.id = rp.id_permiso)
WHERE u.id_rol=" . $_SESSION['idrol'];


$resultDerivadorNombreRol = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

if (!$resultDerivadorNombreRol || !sqlsrv_has_rows($resultDerivadorNombreRol)) {
    $_SESSION['mensajeLogin'] = "<div class='alert-danger text-center'>No se obtuvieron los datos del perfil para el usuario</div>";
    $log = new Log();
    $log->writeLine("[No se pudo consultar el nombre del rol][{$query}][Redirecciona: index]");
    header("Location: ../index.php");
}

while ($row = sqlsrv_fetch_array($resultDerivadorNombreRol, SQLSRV_FETCH_ASSOC)) {

    $rawdata[$i] = $row['nombre'];
    $i++;
    switch ($row['nombre']) {
        case "GESTIONAR PERMISOS":
            header("Location: ./pai/inicio.php");
            break;

        case "GESTIONAR FORMULARIO":
            header("Location: ./formulario/formularioUsuario/inicio.php");
            break;
    }
}

$_SESSION['json'] = $rawdata;
    
//header("Location: ./pai/inicio.php");
//header("Location: ./formulario/formularioUsuario/inicio.php");
