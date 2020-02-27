<?php
include_once './header.php'
?>

<html>

<head>
    <link rel="stylesheet" href="../css/Alta.css">
</head>

<body>

    <div id="contenedor" class="container">
        <div id="cabecera" class="card">
            <div id="cuerpo" class="card-body">
                <div id="div1">
                    <table class="table table-borderless border-bottom">
                        <th><h3>Solicitudes de Alta</h3></th>
                        <form action="./NuevaAlta.php">
                        <th><button id="th1" class="btn btn-dark">Nueva Solicitud</button></th>
                        </form>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <div id="contenedor1" class="container">
        <div id="cabecera1" class="card">
            <h4>Filtro</h4>
            <div id="cuerpo1" class="card">
                <form action="" class="form-horizontal" role="form">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="FechaPedido">Fecha De Pedido</label>
                            <div class="col-sm-2">
                                <input type="date" id="FechaPedido" name="FechaPedido" class="form-control" value="">
                            </div>
                            <label class="col-sm-2 control-label" for="FechaEjecucion">Fecha De Ejecucion</label>
                            <div class="col-sm-2">
                                <input type="date" id="FechaEjecucion" name="FechaEjecucion" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="FechaPedido">Fecha De Pedido</label>
                            <div class="col-sm-2">
                                <input type="date" id="FechaPedido" name="FechaPedido" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<br>
    <div id="contenedor2" class="container"> 
        <div id="cabecera2" class="card">
            <h4>Consultas Realizadas</h4>
            <div id="cuerpo2" class="card">
              
            </div>

        </div>
    </div>

</body>

</html>