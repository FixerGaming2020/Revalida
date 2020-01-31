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

/* CONSULTA TODOS LOS ROLES Y PERMISOS ASOCIADOS GUARDADOS EN LA BASE DE DATOS */
$queryRoles = "SELECT r.id_rol, r.nombre, COUNT(p.id_permiso) permisos "
        . "FROM rol r, rol_permiso rp, permiso p  "
        . "WHERE rp.id_rol = r.id_rol AND rp.id_permiso = p.id_permiso "
        . "GROUP BY r.nombre, r.id_rol";
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryRoles);

/* CONSULTA TODOS LOS PERMISOS PARA CARGAR EL MODAL */
$query = "SELECT * FROM permiso";
$permisos = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

/* AGREGA LA CABECERA CON EL MENU */
require_once './menuUsuarios.php';
?>

<div class="card-header">
    <h4 class="text-center p-4">BUSCAR ROLES</h4>
    <div id="contenido">
        <form>
            <input type="submit" class="btn btn-success p-2" id="btnNuevoRol" name="btnNuevoRol" value="Nuevo rol"><br>
        </form>
        <?php
        if ($result) {
            if (sqlsrv_has_rows($result)) {
                echo "<br>
                    <input type='hidden' id='seleccionado' name='seleccionado' value=''>
                    <table id='tablaRoles' class='table table-bordered table-hover' >
                        <thead style='background-color:#739cc7;'>
                            <tr>
                                <th class='text-center'>Nombre</th>
                                <th class='text-center'>Permisos asociados</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody >";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo"
                        <tr>
                            <td>{$row['nombre']}</td>
                            <td class='text-center' title='El rol {$row['nombre']} posee {$row['permisos']} permisos actualmente'>{$row['permisos']}</td>
                            <td class='text-center' title='Elimina el rol y la relación que tenga con cada permiso'>
                                <form method='POST' class='borrarRol' name='{$row['id_rol']}'>
                                    <input type='submit' class='btn btn-danger' id='btnBorrarRol' name='btnBorrarRol' value='Borrar'>
                                </form>
                            </td>
                            <td class='text-center' title='Ir a la modificación del rol'>
                                <form method='POST' id='formModificarRol' class='formModificarRol' name='{$row['id_rol']}'>
                                    <input type='hidden' id='id_rol' name='id_rol' value=''>
                                    <input type='submit' class='btn btn-success' id='btnModificarRol' name='btnModificarRol' value='Modificar'>
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
            $log->writeLine("[Error al realizar la busqueda de permsisos en la BD][QUERY: $queryRoles]");
            echo '<div class="alert alert-danger text-center" role="alert"> Error al realizar búsqueda </div>';
        }
        ?>
    </div>
    <div id="contenido2" name="contenido2"></div>
    <?php
    include_once './modalCargarRol.php';
    include_once '../modalBorrar.php';
    ?>
</div>
</body>
<script type="text/javascript" charset="utf8" src="../../lib/JQuery/BuscarRol.js"></script>
</html>