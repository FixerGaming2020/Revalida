<div class="modal fade" id="mdCargarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">ALTA DE ROL</h4>
            </div>
            <div class="modal-body">
                <form id="formCargarRol" name="formCargarRol" method="POST">
                    
                    <?php 
                        if ($permisos && sqlsrv_has_rows($permisos)) {
                            echo '
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nombre:</label> 
                                <div class="col">
                                    <input type="text" class="form-control mb-2" id="nombreRol" name="nombreRol" maxlength="50" placeholder="Nombre de rol" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Permisos:</label> 
                                <div class="col">
                                    <table id="tablaPermisosRol" class="table table-bordered table-hover">
                                        <thead style="background-color:#739cc7;">
                                            <tr>
                                                <th class="text-center" title="Seleccionar todos"><input type="checkbox" id="todosPermisos"></th>
                                                <th class="text-center">Nombre</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color:white;">';
                            while ($row = sqlsrv_fetch_array($permisos, SQLSRV_FETCH_ASSOC)) {
                                echo '
                                    <tr>
                                        <td class="text-center"><input type="checkbox" id="permisos" name="permisos[]" value="'.$row['id_permiso'].'"></td>
                                        <td>'.$row['nombre'].'</td>
                                    </tr>';
                            }
                            echo '      </tbody>
                                    </table>
                                </div>
                            </div>';
                            
                        } else {
                            echo '<div class="alert alert-danger text-center" role="alert"> No se obtuvieron permisos para cargar el formulario </div>';
                        }
                    ?>         
                </form>
            </div>
            <div class="modal-footer">
                <?php 
                if ($permisos && sqlsrv_has_rows($permisos)) {
                    echo "<input type='submit' class='btn btn-success' id='btnCargarRol' value='Guardar'>";
                } 
                ?>
                <input type='submit' class='btn btn-outline-secondary' id='btnCancelarCarga' value='Cancelar'>
            </div>
        </div>
    </div>
</div>