<?php
include_once '../../conf/Constants.php';
include_once '../../conf/Log.php';
include_once '../../conf/BDConexion.php';

session_start();


?>

<html id="html">

<head>
    <meta charset="UTF-8">
    <title>Revalida de Usuarios</title>
    <link rel="stylesheet" href="../../../lib/css/bootstrap-toggle.min.css" />
    <link rel="stylesheet" href="../../../lib/css/estilos.css" />
    <link rel="stylesheet" href="../../../lib/css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../../../lib/css/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="../../../lib/css/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../../lib/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="../../../lib/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/js/loader.js"></script>
    <script type="text/javascript" charset="utf8" src="../../../lib/JQuery/jquery.tablesorter.min.js"></script>
</head>
<style>
    .boton_personalizado {
        text-decoration: none;
        padding: 10px;
        font-weight: 600;
        font-size: 10px;
        color: #ffffff;
        background-color: #164d75;
        border-radius: 4px;
        border: 1px solid  #666;
;
    }

    table.display tbody .odd:hover {
        background-color: red !important;
    }

    table.display tbody .even:hover {
        background-color: blue !important;
    }
</style>

<body style=" background-color:#374B70;     overflow: hidden;">
    <navbar id="menu-horizontal" class="navbar navbar-expand-lg navbar-dark" style="background-color: #fafafa;">
        <div class="container">
            <span><a href="inicio.php"><img src="../../../lib/img/cabezera.png" class="img-thumbnail" alt="Responsive image" width="70" height="70"></a></span>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        &nbsp;&nbsp;<h3 class="text" style="color: #374B70  ">Revalida de Usuarios</h3>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <a class="boton_personalizado" href="../../procesarLogout.php">
                            <h6>SALIR</h6>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </navbar>