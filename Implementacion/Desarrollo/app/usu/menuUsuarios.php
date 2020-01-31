<?php
include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

/* BUSCA EL ROL PARA EL USUARIO GUARDADO EN LA SESION */

$usuario = $_SESSION['legajo'];
$sql = "SELECT nombre FROM rol WHERE id_rol = " . $_SESSION['idrol'];
$resultadoRol = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $sql);

if (!$resultadoRol) {
    $log = new Log();
    $log->writeLine("[No se pudo obtener el nombre del rol][QUERY: $sql][USUARIO: $usuario]");
    $_SESSION['mensajeLogin'] = "<div class='alert-danger text-center' role='alert'>No se obtuvo información asociada al rol para cargar menu de usuarios</div>";
    header("Location: ../../index.php");
}

$row = sqlsrv_fetch_array($resultadoRol);
$nombreRol = $row["nombre"];

if ($nombreRol != "ADMINISTRADOR") {
    $log = new Log();
    $log->writeLine("[Se intento acceder al menu con otro rol][USUARIO: $usuario]");
    $_SESSION['mensajeLogin'] = "<div class='alert-danger text-center' role='alert'>No puede acceder al menu solicitado</div>";
    header("Location: ../../index.php");
}
?>
<html id="html">
    <head>
        <meta charset="UTF-8">
        <title> SIB - USUARIOS</title>
        <link rel="icon" href="../../lib/img/estrella.jpg" type="image/gif" sizes="16x16">
        <link rel="stylesheet" href="../../lib/css/estilos.css"/>
        <link rel="stylesheet" href="../../lib/css/bootstrap/bootstrap.css"/>
        <link rel="stylesheet" href="../../lib/css/datatables/jquery.dataTables.css">
        <link rel="stylesheet" href="../../lib/css/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../../lib/css/buttons.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="../../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/jszip.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/vfs_fonts.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/buttons.flash.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../lib/js/buttons.print.min.js"></script>
    </head>
    <body id="body">
    <navbar id="menu-horizontal" class="navbar-bsc navbar navbar-expand-lg " style="background-color: #024d85;">
        <a class="navbar-brand" href="inicioUsuarios.php">
            <span><a href="inicioUsuarios.php"><img src="../../lib/img/logoBSCTrans.png" class="img-thumbnail" alt="Responsive image"></a></span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" >
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gestión de usuarios </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="formBuscarUsuario.php">Buscar usuarios</a>
                            <a class="dropdown-item" href="formBuscarRoles.php">Buscar roles</a>
                            <a class="dropdown-item" href="formBuscarPermisos.php">Buscar permisos</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" value="Usuario: <?= $_SESSION['legajo'] ?>" readonly>
                    <input class="form-control mr-sm-2" type="text" value="<?= $nombreRol; ?>" readonly>
                    <a href="../procesarLogout.php"><input type="button" class="btn btn-secondary my-2 my-sm-0" value="Salir"></a>
                </form>
            </div>
        </div>
    </navbar> 