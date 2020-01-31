<?php
include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

/* INICIALIZA LA SESION */
session_start();

if (!isset($_SESSION['user'])) {
    /* NO SE HA LOGEADO - NO TIENE PERMISOS */
    $log = new Log();
    $log->writeLine("[No se pudo encontrar un usuario en sesion][Redirecciona: index]");
    header('Location: ../../index.php');
}

/* CONSULTA TODOS LOS PERMISOS GUARDADOS EN LA BASE DE DATOS */
$query = "SELECT * FROM permiso";
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

/* AGREGA LA CABECERA CON EL MENU */
require_once './menuUsuarios.php';
?>

<div class="card-header">
    <h4 class="text-center p-4">BUSCAR PERMISOS</h4>
    <div id="contenido">
        <form>
            <input type="submit" class="btn btn-success p-2" id="btnNuevoPermiso" name="btnNuevoPermiso" value="Nuevo permiso"><br>
        </form>
        <?php
        if ($result) {
            if (sqlsrv_has_rows($result)) {
                echo "<br>
                    <input type='hidden' id='seleccionado' name='seleccionado' value=''>
                    <table id='tablaPermisos' class='table table-bordered' >
                        <thead style='background-color:#739cc7;'>
                            <tr>
                                <th class='text-center'>Nombre</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo"
                        <tr>
                            <td>{$row['nombre']}</td>
                            <td class='text-center' title='Elimina el permiso y la relación que tenga con cada rol'>
                                <form method='POST' class='borrarPermiso' name='{$row['id_permiso']}' > 
                                    <input type='submit' class='btn btn-danger' id='btnBorrarPermiso' name='btnBorrarPermiso' value='Borrar'>
                                </form>
                            </td>
                            <td class='text-center' title='Ir a la modificación del permiso'>
                                <form method='POST' id='formModificarPermiso' class='formModificarPermiso' name='{$row['id_permiso']}'>
                                    <input type='hidden' id='id_permiso' name='id_permiso' value=''>
                                    <input type='submit' class='btn btn-success' id='btnModificarPermiso' name='btnModificarPermiso' value='Modificar'>
                                </form>
                            </td>
                        </tr>";
                }
                echo'</tbody>
                    </table>';
            } else {
                echo '<div class="alert alert-warning text-center" role="alert"> No se encontraron resultados </div>';
            }
        } else {
            $log = new Log();
            $log->writeLine("[Error al realizar la busqueda de permsisos en la BD][QUERY: $query]");
            echo '<div class="alert alert-danger text-center" role="alert"> Error al realizar búsqueda </div>';
        }
        ?>
    </div>
    <div id="contenido2" name="contenido2"></div>
    <?php
    include_once './modalCargarPermiso.php';
    include_once '../modalBorrar.php';
    ?>
</div>
</body>
<script type="text/javascript" src="../../lib/JQuery/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="../../lib/JQuery/BuscarPermiso.js"></script>
</html>