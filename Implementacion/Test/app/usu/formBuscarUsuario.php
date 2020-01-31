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

/* CONSULTA TODOS LOS USUARIOS GUARDADOS EN LA BASE DE DATOS */
$query = "SELECT u.legajo, u.nombre, u.id_rol, r.nombre rol FROM usuario u LEFT JOIN rol r ON u.id_rol = r.id_rol";
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

/* CONSULTA TODOS LOS ROLES GUARDADOS EN LA BASE DE DATOS PARA CARGAR EL MODAL */
$queryUsuario = "SELECT * FROM rol";
$roles = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $queryUsuario);

/* AGREGA LA CABECERA CON EL MENU */
require_once './menuUsuarios.php';
?>

<div class="card-header">
    <h4 class="text-center p-4">BUSCAR USUARIO</h4>
    <div id="contenido">
        <form>
            <input type="submit" class="btn btn-success p-2" id="btnNuevoUsuario" name="btnNuevoUsuario" value="Nuevo usuario"><br>
        </form>

        <?php
        if ($result) {
            if (sqlsrv_has_rows($result)) {
                echo "<br>
                    <input type='hidden' id='seleccionado' name='seleccionado' value=''>
                    <table id='tablaUsuarios' class='table table-bordered' >
                        <thead style='background-color:#739cc7;'>
                            <tr>
                                <th class='text-center'>Legajo</th>
                                <th class='text-center'>Nombre</th>
                                <th class='text-center'>Rol</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo"
                            <tr>
                                <td>{$row['legajo']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['rol']}</td>
                                <td class='text-center'>
                                    <form method='POST' class='borrarUsuario' name='{$row['legajo']}'>
                                        <input type='submit' class='btn btn-danger' id='btnBorrarUsuario' name='btnBorrarUsuario' value='Borrar'>
                                    </form>
                                </td>
                                <td class='text-center'>
                                    <form method='POST' id='formModificarUsuario' class='modificarUsuario' name='{$row['legajo']}'>
                                        <input type='hidden' id='legajo' name='legajo' value=''>
                                        <input type='submit' class='btn btn-success' id='btnModificarUsuario' name='btnModificarUsuario' value='Modificar'>
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
            $log->writeLine("[Error al realizar la busqueda de usuarios en la BD][QUERY: $queryUsuario]");
            echo '<div class="alert alert-danger" role="alert"> Error al realizar búsqueda </div>';
        }
        ?>
    </div>
    <div id="contenido2" name="contenido2"></div>
    <?php
    include_once './modalCargarUsuario.php';
    include_once '../modalBorrar.php';
    ?>
</div>
</body>
<script type="text/javascript" charset="utf8" src="../../lib/JQuery/BuscarUsuario.js"></script>
</html>