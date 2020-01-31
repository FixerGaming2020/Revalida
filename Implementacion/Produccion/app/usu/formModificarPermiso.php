<?php
include_once '../conf/Constants.php';
include_once '../conf/Log.php';
include_once '../conf/BDConexion.php';

session_start();

/* Se obtiene el id para buscar los datos de la BD */

$idpermiso = $_GET['id_permiso'];

/* Realiza la consulta de la informacion del permiso seleccionado */

$query = "SELECT * FROM permiso WHERE id_permiso=" . $idpermiso;
$result = sqlsrv_query(BDConexion::getInstancia()->getConexion(), $query);

include_once './menuUsuarios.php';
?>

<div class="card-header">
    <h4 class="text-center p-4">MODIFICAR PERMISO</h4>
    <div id="contenido">
        <?php
        if ($result) {
            $permiso = sqlsrv_fetch_array($result);
            echo '
            <form id="formModificarPermiso" name="formModificarPermiso" method="POST">
                <input type="hidden" id="id_permiso" name="id_permiso" value="' . $permiso['id_permiso'] . '">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nombre:</label> 
                    <div class="col">
                       <input type="text" class="form-control mb-2" id="nombrePermiso" name="nombrePermiso" value="' . $permiso['nombre'] . '" maxlength="50" placeholder="Nombre de permiso" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" id="btnModificarPermiso" name="btnModificarPermiso" value="Guardar">
                            <input type="button" class="btn btn-outline-secondary" value="Cancelar" onclick="history.back()">
                        </div>
                    </div>
                </div> 
            </form>';
        } else {
            $log = new Log();
            $log->writeLine("[Error al realizar la busqueda del permsiso en la BD][QUERY: $query]");
            echo '<div class="alert alert-danger text-center" role="alert"> No se pudo consultar la información del permiso </div>';
        }
        ?>
    </div>
    <div id="contenido2" name="contenido2"></div>
</div>
</body>
<script type="text/javascript" charset="utf8" src="../../lib/JQuery/ModificarPermiso.js"></script>
</html>