<?php
include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

session_start();

/* Se obtiene el id para obtener los datos de la BD */
$idrol = $_GET['id_rol'];

$query = "SELECT * FROM rol WHERE id_rol={$idrol}";
$rol = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

$query = "SELECT * FROM rol_permiso WHERE id_rol={$idrol} ORDER BY id_permiso ASC";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

$permisosRol = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query, $params, $options);

$query = "SELECT * FROM permiso ORDER BY id_permiso ASC";
$permisos = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);


include_once './menuUsuarios.php';
?>

<div class="card-header">
    <h4 class="text-center p-4">MODIFICAR ROL</h4>
    <div id="contenido">
        <?php
        if ($rol && $permisosRol && $permisos) {

            $rolmod = sqlsrv_fetch_array($rol);

            if (sqlsrv_has_rows($rol) && sqlsrv_has_rows($permisosRol) && sqlsrv_has_rows($permisos)) {

                echo '
                <form id="formModificarRol" name="formModificarRol" method="POST">
                    <input type="hidden" id="id_rol" name="id_rol" value="' . $rolmod['id_rol'] . '">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre:</label> 
                        <div class="col">
                           <input type="text" class="form-control mb-2" id="nombreRol" name="nombreRol" value="' . $rolmod['nombre'] . '" maxlength="50" placeholder="Nombre de rol" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Permisos:</label> 
                        <div class="col">
                            <table id="tablaPermisosRol" class="table table-bordered table-hover">
                                <thead style="background-color:#739cc7;">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Nombre</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color:white;">';
                $cantidadPermisos = sqlsrv_num_rows($permisosRol);
                while ($row = sqlsrv_fetch_array($permisos, SQLSRV_FETCH_ASSOC)) {
                    $i = 0;
                    $checked = "";
                    while ($i < $cantidadPermisos) {
                        $permisoRol = sqlsrv_fetch_array($permisosRol, SQLSRV_FETCH_ASSOC, SQLSRV_SCROLL_ABSOLUTE , $i);
                        if($row['id_permiso'] == $permisoRol['id_permiso']) {
                            $checked = "checked";
                            $i = $cantidadPermisos;
                        }
                        $i++;
                    }
                    echo '
                        <tr>
                            <td class="text-center"><input type="checkbox" id="permisos" name="permisos[]" value="' . $row['id_permiso'] . '" '.$checked.'></td>
                            <td>' . $row['nombre'] . '</td>
                        </tr>';
                }
                echo'           </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <input type="submit" class="btn btn-success" id="btnModificarRol" name="btnModificarRol" value="Guardar">
                                <input type="button" class="btn btn-outline-secondary" value="Cancelar" onclick="history.back()">
                            </div>
                        </div>
                    </div>   
                </form>';
            } else {
                echo '<div class="alert alert-danger text-center" role="alert"> No se obtuvo la información del rol </div>';
            }
        } else {
            $log = new Log();
            $log->writeLine("[Error al realizar la busqueda del rol, permisos o asociados en la BD][QUERY: $query]");
            echo '<div class="alert alert-danger text-center" role="alert"> No se pudo consultar la información del rol </div>';
        }
        ?>
    </div>
    <div id="contenido2" name="contenido2"></div>
</div>
</body>
<script type="text/javascript" charset="utf8" src="../../lib/JQuery/ModificarRol.js"></script>
</html>

