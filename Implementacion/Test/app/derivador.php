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

/*

$query = "SELECT nombre FROM rol WHERE id_rol=" . $_SESSION['idrol'];
$resultDerivadorNombreRol = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);


if (!$resultDerivadorNombreRol || !sqlsrv_has_rows($resultDerivadorNombreRol)) {
    $_SESSION['mensajeLogin'] = "<div class='alert-danger text-center'>No se obtuvieron los datos del perfil para el usuario</div>";
    $log = new Log();
    $log->writeLine("[No se pudo consultar el nombre del rol][{$query}][Redirecciona: index]");
    header("Location: ../index.php");
}

while ($row = sqlsrv_fetch_array($resultDerivadorNombreRol, SQLSRV_FETCH_ASSOC)) {

    switch ($row['nombre']) {
        case "NORMAL":
            header("Location: ./gar/inicioGarantias.php");
            break;
        case "CONSULTA":
            header("Location: ./gar/inicioGarantias.php");
            break;
        case "REPORTES":
            header("Location: ./rep/inicioReportes.php");
            break;
        case "MONITOR":
            header("Location: ./gsuc/reportesTablas.php");
            break;
        case "REPSUC01":
            $_SESSION['sucursal'] = 1;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC05":
            $_SESSION['sucursal'] = 5;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC10":
            $_SESSION['sucursal'] = 10;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC15":
            $_SESSION['sucursal'] = 15;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC20":
            $_SESSION['sucursal'] = 20;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC25":
            $_SESSION['sucursal'] = 25;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC30":
            $_SESSION['sucursal'] = 30;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC40":
            $_SESSION['sucursal'] = 40;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC41":
            $_SESSION['sucursal'] = 41;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC45":
            $_SESSION['sucursal'] = 45;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC50":
            $_SESSION['sucursal'] = 50;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC55":
            $_SESSION['sucursal'] = 55;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC60":
            $_SESSION['sucursal'] = 60;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC70":
            $_SESSION['sucursal'] = 70;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC80":
            $_SESSION['sucursal'] = 80;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "REPSUC85":
            $_SESSION['sucursal'] = 85;
            header("Location: ./suc/inicioSucursal.php");
            break;
        case "ADMINISTRADOR":
            header("Location: ./usu/inicioUsuarios.php");
            break;
		case "RECUPERACION CREDITICIA":
            header("Location: ./crediticia/inicio.php");
            break;
        case "GEROPECEN":
            header("Location: ./gope/formReportesTablas.php");
            break;
		case "BANCA CONSUMO":
            header("Location: ./consumo/inicio.php");
            break;
		case "BANCA EMPRESAS":
            header("Location: ./bancaEmpresas/inicio.php");
            break;
		case "MONITOREO TC":
            header("Location: ./monitoreoTC/inicio.php");
            break;
		case "RECURSOS HUMANOS":
            header("Location: ./recursosHumanos/inicio.php");
            break;
		case "RECAUDACIONES":
            header("Location: ./recaudaciones/inicio.php");
            break;
		case "CLEARING":
            header("Location: ./clearing/inicio.php");
            break;
		case "RECURSOS MATERIALES":
            header("Location: ./recursosMateriales/inicio.php");
            break;
		case "FINANZAS":
            header("Location: ./finanzas/inicio.php");
            break;
		case "IMPUESTOS":
            header("Location: ./impuestos/inicio.php");
            break;
    }
}

*/
