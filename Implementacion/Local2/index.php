<?php
require_once './app/Conexion/Modelo/Constantes.php';
require_once './app/Conexion/Modelo/AutoCargador.php';

AutoCargador::cargarModulos();

session_start();

$sessionMensaje = "";
// Consulto si se apreto el boton de ingresar
if (isset($_POST['btnIngreso'])) {
    $legajo = $_POST['user']; //Obtengo el usuario
    $clave = $_POST['password']; //Obtengo el Password
    $controlador = new ControladorConexion(); //creo un objeto ContrladorConexion
    $autorizado = $controlador->verificarUsuarioSistema($legajo, $clave);
    if ($autorizado) {
        Log::guardarConexion("INGRESO", "USUARIO AUTORIZADO PARA INGRESAR");
        header("Location: app/Conexion/Vista/home.php");
    } else {
        $mensaje = $controlador->getMensaje();
        Log::guardarError("INGRESO", $mensaje);
        $sessionMensaje = '<div class="alert alert-danger text-center"><strong>' . $mensaje . '</strong></div>';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Revalida de Usuarios</title>
        <link rel="icon" href="lib/img/estrella.jpg" type="image/gif" sizes="16x16">
        <link rel="stylesheet" type="text/css" href="lib/css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="lib/css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="lib/css/login.css" />
        <script type="text/javascript" charset="utf8" src="lib/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="lib/js/bootstrap/bootstrap.min.js"></script>
    </head>
    <body style=" background-image: url(lib/img/fondobanco2.png); background-position: center;  background-repeat: no-repeat; background-attachment: fixed; background-size:cover ;">
        <div class="form-row align-items-center mx-auto">
            <div class="col-lg-12 text-center p-2">
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
        <div class="login">
            <?= $sessionMensaje; ?>
            <div class="login-triangle"></div>
            <h2 class="login-header">ingresar</h2>
            <!-- ingreso el nombre de Usuario y La contraseña -->
            <form class="login-container" method="POST">
                <p><input type="text" id="user" name="user" placeholder="Usuario" required></p>
                <p><input type="password" id="password" name="password" placeholder="Contraseña" required></p>
                <p><input type="submit" id="btnIngreso" name="btnIngreso" value="Ingresar"></p>
            </form>
        </div>
    </body>
</html>
