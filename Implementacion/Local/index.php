<?php
require_once './app/Conexion/Modelo/Constants.php';
require_once './app/Conexion/Modelo/AutoCargador.php';

AutoCargador::cargarModulos();

session_start();

$sessionMensaje = "";

if (isset($_POST['btnIngreso'])) {
    print_r("ENTRO");

    $legajo = $_POST['user'];
    $clave = $_POST['password'];
    $controlador = new ControladorConexion();
    $autorizado = $controlador->verificarUsuarioSistema($legajo, $clave);
    if ($autorizado) {
        print_r("ENTRO");
        header("Location app/principal/Vista/home.php");
    } else {
        print_r("ERRORRR");
        Log::errorConexion("USUARIO {$legajo} NO AUTORIZADO PARA INGRESAR POR ACTIVE DIRECTORY");
        // $mensaje = $controlador->getMensaje();
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

<body style=" background-image: url(lib/Imagenes/fondobanco2.png); background-position: center;  background-repeat: no-repeat; background-attachment: fixed; background-size:cover ;">
    <div class="form-row align-items-center mx-auto">
        <div class="col-lg-12 text-center p-2">
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
  
    <div class="login">
        <div class="login-triangle"></div>

        <h2 class="login-header">ingresar</h2>

        <form class="login-container" method="POST">
            <p><input type="text" id="user" placeholder="Usuario"  required></p>
            <p><input type="password" id="password" placeholder="Contraseña" required></p>
            <p><input type="submit" id="btnIngreso" value="Ingresar"></p>
        </form>
    </div>
</body>
<!-- 
<div class="modal modal-center modal-dark" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-centered" style="background-color: #4169A0">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="pe-7s-close pe-2x"></i></span>
                </button>
                <h2 class="modal-title" id="subscribeModalLabel">Acceso a Revalida de Usuarios</h2>
                <br>

                <form method="POST">
                    <div class="form-group md-form">
                        <?php $sessionMensaje ?>
                        <input type="text" name="user" id="user" class="form-control input-material" autocomplete="off" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label style="color:BLACK;" size="8">LEGAJO</label>
                    </div>
                    <div class="form-group md-form">
                        <input type="password" name="password" id="password" class="form-control input-material" autocomplete="off" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label style="color:BLACK;" size="8">CONTRASE&Ntilde;A</label>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="btnIngreso" id="btnIngreso" class="btn btn-outline-success btn-block" title="Ingresar a CAP" value="INGRESAR">
                        <div id="js-subscribe-result" data-success-msg="Success, Please check your email." data-error-msg="Oops! Something went wrong"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->




</html>