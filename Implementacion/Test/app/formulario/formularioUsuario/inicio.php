<?php
include_once '../../conf/Constants.php';
include_once '../../conf/Log.php';
include_once '../../conf/BDConexion.php';

require_once './script.php';

require_once './header.php';

session_start();

if (!isset($_SESSION['user'])) {
    /* NO SE HA LOGEADO - NO TIENE PERMISOS */
    $log = new Log();
    $log->writeLine("[No se pudo encontrar un usuario en sesion][Redirecciona: index]");
    header('Location: ../../index.php');
}

?>

<!-- PAGINA DE FORMULARIO -->

<html>

<head>
    <script type="text/javascript" src="../../../lib/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="../../../lib/js/jquery.easing.compatibility.js"></script>

</head>

<body>

    <div>
        <div id="contenido">
            <!--Div sobre el cual voy a cargar aquellos datos que traigo del JS -->
            <br>
            <div class=" row">
                <div class="col">
                    <div class="text-center">
                        <h4 style="color:WHITE"><u>SISTEMA DE FORMULARIOS</u></h4>
                    </div>
                </div>
            </div>
            <br>
            <div id="centro" class="container">
                <div class="row">
                    <div class="col text-center">
                        <p style="color:white">La creacion del formulario 783 va a permitir habilitar el uso de las aplicaciones del banco</p>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <div class="row justify-content-center " style="margin-top:10%;">
                <div class=" col-center ">
                    <input type="submit" class="btn btn btn-lg" style="color:#374B70" id="btnNuevo" name="btnNuevo" value="Formulario" />
                    <!--Boton para crear el formulario-->
                </div>
            </div>
        </div>
        <div id="contenido2" name="contenido2"></div>
        <!--Div sobre el cual voy a cargar aquellos datos que traigo del JS -->
    </div>



</body>

</html>

<?php include_once 'modalAplicacion.php'; ?>