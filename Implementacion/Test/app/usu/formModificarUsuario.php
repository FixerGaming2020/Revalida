<?php

include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

session_start();

include_once './menuUsuarios.php';

/* Se obtiene el id para obtener los datos de la BD */
$legajo = $_GET['legajo'];

$queryUsuario = "SELECT * FROM usuario WHERE legajo='{$legajo}'";
$usuario = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryUsuario);

$queryRol = "SELECT * FROM rol";
$roles = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryRol);

?>

<div class="card-header">
    <h4 class="text-center p-4">MODIFICAR USUARIO</h4>
    <div id="contenido">
        <?php
        if ($usuario && sqlsrv_has_rows($usuario) && $roles && sqlsrv_has_rows($roles)) {
            $user = sqlsrv_fetch_array($usuario);
            echo '
            <form id="formModificarUsuario" name="formModificarUsuario" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Legajo:</label> 
                    <div class="col">
                       <input type="text" class="form-control mb-2" id="legajo" name="legajo" value="' . $user['legajo'] . '" placeholder="Legajo de usuario" disabled required>
                    </div>
                    <label class="col-sm-2 col-form-label">Nombre:</label> 
                    <div class="col">
                       <input type="text" class="form-control mb-2" id="nombre" name="nombre" value="' . $user['nombre'] . '" placeholder="Nombre de usuario" required>
                    </div>
                <div class="w-100"></div>
                    <label class="col-sm-2 col-form-label">Rol:</label> 
                    <div class="col">
                        <select class="form-control mb-2" id="rol" name="rol">';
            while ($rows = sqlsrv_fetch_array($roles, SQLSRV_FETCH_ASSOC)) {

                if ($user['id_rol'] == $rows['id_rol']) {
                    echo "<option value='{$rows['id_rol']}' selected>{$rows['nombre']}</option>";
                } else {
                    echo "<option value='{$rows['id_rol']}'>{$rows['nombre']}</option>";
                }
            }
            echo '      </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" id="btnModificarUsuario" name="btnModificarUsuario" value="Guardar">
                            <input type="button" class="btn btn-outline-secondary" value="Cancelar" onclick="history.back()">
                        </div>
                    </div>
                </div>
            </form>';
        } else {
            $log = new Log();
            $log->writeLine("[Error al realizar la busqueda del usuario o roles en la BD][QUERY: $queryUsuario][QUERY: $queryRol]");
            echo '<div class="alert alert-danger text-center" role="alert"> No se obtuvo la información del usuario a modificar </div>';
        }
        ?>
    </div>
    <div id="contenido2" name="contenido2"></div>
</div>
</body>
<script type="text/javascript" charset="utf8" src="../../lib/JQuery/ModificarUsuario.js"></script>
</html>